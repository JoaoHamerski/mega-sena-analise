<?php

namespace App\Actions;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class GetLateNumbersAction
{
    public static function execute(int $lateByDays = 60): array
    {
        $lateNumbers = static::getLateNumbers($lateByDays);

        return [
            'data' => static::filterByLateByDays($lateNumbers, $lateByDays),
            'interval' => $lateByDays
        ];
    }

    public static function getLateNumbers(): Collection
    {
        $numbers = Cache::has('mega-sena:numbers')
            ? Cache::get('mega-sena:numbers')
            : GetNumbersAction::execute();

        $totalGames = Game::count();

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
        return Game::whereNumber($number)
            ->orderBy('data', 'desc')
            ->first();
    }

    public static function filterByLateByDays(Collection $lateNumbers, int $lateBy): Collection
    {
        $maxDate = Carbon::now()->subDays($lateBy);

        $filteredLateNumbers = $lateNumbers->filter(
            fn ($number) => $number['last_game']['data'] < $maxDate
        );

        return $filteredLateNumbers->values();
    }
}
