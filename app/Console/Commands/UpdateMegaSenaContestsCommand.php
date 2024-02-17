<?php

namespace App\Console\Commands;

use App\Actions\UpdateMegaSenaContestsAction;
use App\Models\Contest;
use Illuminate\Console\Command;

class UpdateMegaSenaContestsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mega-sena:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza os concursos da Mega Sena.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Atualizando concursos...');

        $contestsCount = Contest::count();
        $newContests = UpdateMegaSenaContestsAction::execute();
        $newContestsCount = $newContests->count();

        if ($contestsCount < $newContestsCount) {
            $this->info('Novos concursos adicionados: ' . ($newContestsCount - $contestsCount));
            return;
        }

        $this->info('Nenhum novo concurso desde a última atualização.');
    }
}
