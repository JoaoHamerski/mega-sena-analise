<?php

namespace App\Http\Controllers;

use App\Http\Requests\MegaSenaDataRequest;
use App\Models\Game;
use App\Traits\MegaSenaHomeNumbersRelative;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class MegaSenaHomeStatsController extends Controller
{
    use MegaSenaHomeNumbersRelative;

    public function __invoke(MegaSenaDataRequest $request)
    {
        return [
            'unlucky_numbers' => $this->getNumbersByLongestLastOccurrence($request)
        ];
    }

    public function getNumbersByItsLastOccurrence()
    {
        $numbers = collect(Cache::get('mega-sena:numbers'));

        return $numbers->map(function ($number) {
            $lastOccurrenceGame = Game::whereNumber($number['number'])->orderBy('date', 'DESC')->first();

            return [
                ...$number,
                ...['game' => $lastOccurrenceGame->toArray()]
            ];
        });
    }

    public function filterByLongestOccurrences($games, $interval)
    {
        $lessThanDate = Carbon::now()->subDays($interval);

        return $games->filter(function ($item) use ($lessThanDate) {
            $date = Carbon::createFromFormat('Y-m-d', $item['game']['date']);

            return $date < $lessThanDate;
        });
    }

    public function getNumbersByLongestLastOccurrence()
    {
        $INTERVAL_OF_DAYS = 30;

        $games = $this->getNumbersByItsLastOccurrence();

        $games = $this->filterByLongestOccurrences($games, $INTERVAL_OF_DAYS);

        return $games->sortBy('number')
            ->values();
    }
}
