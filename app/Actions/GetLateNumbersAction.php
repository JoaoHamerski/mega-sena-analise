<?php

namespace App\Actions;

use App\Models\Game;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class GetLateNumbersAction
{
    public static function execute(): Collection
    {
        $totalGames = Game::count();
        $numbers =  Cache::get('mega-sena:numbers', fn () => GetNumbersAction::execute());

        return $numbers->map(function ($number) use ($totalGames) {
            $game = static::getLastGameOfNumber($number['number']);

            return [
                ...$number,
                'last_game' => $game,
                'late_by_games' => $totalGames - $game->concurso
            ];
        });
    }

    public static function getLastGameOfNumber(int $number): Game
    {
        return Game::whereContainsNumber($number)
            ->orderBy('data', 'desc')
            ->first();
    }
}
