<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Http\Requests\MegaSenaRequest;
use App\Traits\MegaSenaQueryTrait;
use Illuminate\Support\Arr;

class StatsOddEvenResultsController extends Controller
{
    use MegaSenaQueryTrait;

    /**
     * Handle the incoming request.
     */
    public function __invoke(MegaSenaRequest $request)
    {
        $games = $this->queryGames($request)->get();

        $oddGamesCount = $this->getArrayStructure();
        $evenGamesCount = $this->getArrayStructure();

        $games->each(function ($game) use (&$evenGamesCount, &$oddGamesCount) {
            $count = $this->countGameOddEven($game);

            $this->assignResults($evenGamesCount, $count['even']);
            $this->assignResults($oddGamesCount, $count['odd']);
        });

        $evenGamesCount = $this->applyPercentages($evenGamesCount);
        $oddGamesCount = $this->applyPercentages($oddGamesCount);

        return [
            'even_games_count' => $evenGamesCount,
            'odd_games_count' => $oddGamesCount
        ];
    }

    public function applyPercentages($gamesCount)
    {
        $total = collect($gamesCount)->pluck('occurrences')->sum();

        return Arr::map(
            $gamesCount,
            fn ($item) => [
                'occurrences' => $item['occurrences'],
                'percentage' => +bcdiv(100 * $item['occurrences'], $total, 2)
            ]
        );
    }

    public function assignResults(&$gamesCount, $count)
    {
        $gamesCount["count_{$count}"]['occurrences']++;
    }

    public function getArrayStructure()
    {
        return Arr::mapWithKeys(range(0, 6), fn ($num) => ["count_{$num}" => [
            'occurrences' => 0,
            'percentage' => 0
        ]]);
    }

    public function countGameOddEven($game)
    {
        $odd = 0;
        $even = 0;

        foreach (range(1, 6) as $num) {
            if (AppHelper::isEven($game->{'bola_' . $num})) {
                $even++;
            } else {
                $odd++;
            }
        }

        return compact('odd', 'even');
    }
}
