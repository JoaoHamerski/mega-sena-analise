<?php

namespace App\Console\Commands;

use App\Actions\UpdateMegaSenaGamesAction;
use App\Models\Game;
use Illuminate\Console\Command;

class UpdateMegaSenaGamesCommand extends Command
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
    protected $description = 'Atualiza os jogos da Mega Sena.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Atualizando jogos...');

        $gamesCount = Game::count();
        $newGames = UpdateMegaSenaGamesAction::execute();
        $newGamesCount = $newGames->count();

        if ($gamesCount < $newGamesCount) {
            $this->info('Novos jogos adicionados: ' . ($newGamesCount - $gamesCount));
            return;
        }

        $this->info('Nenhum novo jogo desde a última atualização.');
    }
}
