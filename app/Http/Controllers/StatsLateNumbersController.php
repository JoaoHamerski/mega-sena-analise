<?php

namespace App\Http\Controllers;

use App\Http\Requests\MegaSenaRequest;
use App\Models\Game;
use App\Traits\MegaSenaNumbersTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class StatsLateNumbersController extends Controller
{
    use MegaSenaNumbersTrait;

    /**
     * Handle the incoming request.
     */
    public function __invoke(MegaSenaRequest $request)
    {
        Validator::make($request->all(), [
            'interval' => ['required', 'integer']
        ])->validate();

        return [
            'interval' => $request->query('interval'),
            'late_numbers' => $this->getNumbersByLongestLastOccurrence($request)
        ];
    }

    public function getNumbersByItsLastOccurrence(MegaSenaRequest $request)
    {
        $numbers = $this->getNumbersWithOccurrences($request);
        $lastConcursoNumber = Game::orderBy('date', 'DESC')->first()->concurso;

        return $numbers->map(function ($number) use ($lastConcursoNumber) {
            $lastOccurrenceGame = Game::whereNumber($number['number'])
                ->orderBy('date', 'DESC')
                ->first();

            return [
                ...$number,
                ...[
                    'game' => $lastOccurrenceGame->toArray(),
                    'last_occurrence_in' => $lastConcursoNumber - $lastOccurrenceGame['concurso']
                ]
            ];
        });
    }

    public function getNumbersByLongestLastOccurrence($request)
    {
        $numbers = $this->getNumbersByItsLastOccurrence($request);
        $intervalOfDays = $request->query('interval');

        $games = $this->filterByLongestOccurrences($numbers, $intervalOfDays);

        return $games->sortBy('number')->values();
    }

    public function filterByLongestOccurrences($games, $interval)
    {
        $maxOccurrenceDate = Carbon::now()->subDays($interval);

        return $games->filter(
            fn ($item) => $item['game']['date'] < $maxOccurrenceDate
        );
    }
}
