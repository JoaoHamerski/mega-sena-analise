<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Traits\MegaSenaNumbersRelativeTrait;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StatsLateNumbersController extends Controller
{
    use MegaSenaNumbersRelativeTrait;

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

    public function getNumbersByItsLastOccurrence()
    {
        $numbers = collect(Cache::get('mega-sena:numbers'));
        $lastConcursoNumber = Game::latest()->first()->concurso;

        return $numbers->map(function ($number) use ($lastConcursoNumber) {
            $lastOccurrenceGame = Game::whereNumber($number['number'])->orderBy('date', 'DESC')->first();

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
        $lessThanDate = Carbon::now()->subDays($interval);

        return $games->filter(function ($item) use ($lessThanDate) {
            $date = Carbon::createFromFormat('Y-m-d', $item['game']['date']);

            return $date < $lessThanDate;
        });
    }

    public function getNumbersByLongestLastOccurrence($intervalOfDays)
    {
        $games = $this->getNumbersByItsLastOccurrence();

        $games = $this->filterByLongestOccurrences($games, $intervalOfDays);

        return $games->sortBy('number')
            ->values();
    }
}
