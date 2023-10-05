<?php

namespace App\Console\Commands;

use App\Helpers\MegaSenaHelper;
use App\Interfaces\MegaSenaDataFetchInterface;
use App\Interfaces\MegaSenaDataInterface;
use App\MegaSenaData;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class UpdateMegaSenaGames extends Command implements MegaSenaDataInterface, MegaSenaDataFetchInterface
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-mega-sena-games';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update mega sena games from HTTP source.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->fetchResultsFile();
        $filepath = $this->storeFile($file);
        $data = $this->getDataFromFile($filepath);
        $games = $this->storeFileResults($data);

        if ($games->count()) {
            $this->info('Novos jogos registrados: ' . $games->count());
            return;
        }

        $this->info('Nenhum novo jogo registrado');
    }

    public function fetchResultsFile(): mixed
    {
        $this->info('Baixando arquivo de resultados...');

        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => http_build_query([
                    'l' => 'ms',
                    't' => 't',
                    'o' => 's',
                    'f1' => '',
                    'f2' => ''
                ])
            ],
        ]);

        return file_get_contents('https://asloterias.com.br/download_excel.php', false, $context);
    }

    public function getDataFromFile(string $path): Collection
    {
        return MegaSenaHelper::getDataFromAsLoteriasFile(
            storage_path('app/' . $path)
        );
    }

    public function storeFileResults($file): Collection
    {
        return MegaSenaHelper::storeData($file);
    }

    public function storeFile($content): string
    {
        $this->info('Armazenando arquivo...');
        $filepath = 'games/all-games.xlsx';

        Storage::put($filepath, $content);

        return $filepath;
    }
}
