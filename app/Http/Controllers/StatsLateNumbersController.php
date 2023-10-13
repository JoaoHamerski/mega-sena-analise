<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StatsLateNumbersController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = Validator::make($request->all(), [
            'interval' => ['required', 'integer']
        ])->validate();

        return [
            'interval' => $data['interval'],
            'late_numbers' => $this->getNumbersByLongestLastOccurrence($data['interval'])
        ];
    }

    public function getNumbersByLongestLastOccurrence($intervalOfDays)
    {
        $numbers = $this->getNumbersByItsLastOccurrence();

        $games = $this->filterByLongestOccurrences($numbers, $intervalOfDays);

        return $games->sortBy('number')->values();
    }

    public function getNumbersByItsLastOccurrence()
    {
        $numbers = collect(Cache::get('mega-sena:numbers'));
        $lastConcursoNumber = Game::latest()->first()->concurso;

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

    public function filterByLongestOccurrences($games, $interval)
    {
        $maxOccurrenceDate = Carbon::now()->subDays($interval);

        return $games->filter(
            fn ($item) => $item['game']['date'] < $maxOccurrenceDate
        );
    }
}
