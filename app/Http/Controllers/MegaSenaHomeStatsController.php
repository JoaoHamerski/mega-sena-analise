<?php

namespace App\Http\Controllers;

use App\Http\Requests\MegaSenaDataRequest;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MegaSenaHomeStatsController extends Controller
{
    public function __invoke(MegaSenaDataRequest $request)
    {
        return [
            'unlucky_numbers' => $this->getNumbersByLongestLastOccurrence($request)
        ];
    }

    public function getNumbersByItsLastOccurrence()
    {

        $games = collect();

        for ($i = 1; $i <= 60; $i++) {
            $lastOccurrenceGame = Game::whereNumber($i)->orderBy('date', 'DESC')->first();

            $games->push([
                'number' => $i,
                'game' => $lastOccurrenceGame->toArray(),
            ]);
        }

        return $games;
    }

    public function filterByLongestOccurrences($games, $interval)
    {
        $lessThanDate = Carbon::now()->subDays($interval);

        return $games->filter(function ($item) use ($lessThanDate) {
            $date = Carbon::createFromFormat('Y-m-d', $item['game']['date']);

            return $date < $lessThanDate;
        });
    }

    public function getNumbersByLongestLastOccurrence($request)
    {
        $INTERVAL_OF_DAYS = 30;

        $games = $this->getNumbersByItsLastOccurrence();

        return $this->filterByLongestOccurrences($games, $INTERVAL_OF_DAYS)
            ->sortBy('games.date')
            ->values();
    }
}
