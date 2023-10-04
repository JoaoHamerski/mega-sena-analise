<?php

namespace App\Http\Controllers;

use App\Http\Requests\MegaSenaDataRequest;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;

class MegaSenaDataController extends Controller
{
    public function __invoke(MegaSenaDataRequest $request)
    {
        $ballsData = $this->getDataFromAllBalls($request);
        $mergedNumbers = $this->mergeNumberOccurrences($ballsData);
        $metadata = $this->getMetadata($mergedNumbers);
        $numbers = $this->formatNumbers($mergedNumbers, $metadata, $request);

        return Inertia::render('Home/TheHome', compact('numbers', 'metadata'));
    }

    public function formatNumbers(array $numbers, array $metadata, MegaSenaDataRequest $request): Collection
    {
        $numbers = collect($numbers);

        $numbers = $this->addRelativeOccurrences($numbers, $metadata);

        if ($request->input('sort')) {
            return $numbers->sortByDesc('occurrences')->values();
        }

        return $numbers;
    }

    public function addRelativeOccurrences(Collection $numbers, $metadata)
    {
        return $numbers->map(fn ($number) => [
            'number' => $number['number'],
            'occurrences' => $number['occurrences'],
            'relative_occurrences' => $this->getRelativeOccurrence($number['occurrences'], $metadata)
        ], $numbers);
    }

    public function getRelativeOccurrence($occurrences, $metadata)
    {
        $max = $metadata['max'];
        $min = $metadata['min'];

        if ($max === 0 && $min === 0) {
            return 0;
        }

        return (($occurrences - $min) / ($max - $min)) * 100;
    }

    public function getMetadata(array $numbers)
    {
        $numbers = collect($numbers);

        return [
            'max' => $numbers->pluck('occurrences')->max(),
            'min' => $numbers->pluck('occurrences')->min()
        ];
    }

    public function getCountOfBallNumber($item, $number)
    {
        $game = $item->where('ball', $number)->first();

        return $game ? $game['count'] : 0;
    }

    public function mergeNumberOccurrences($balls): array
    {
        $INITIAL_TOTAL = 0;
        $data = [];

        for ($i = 1; $i <= 60; $i++) {
            $number = $i;
            $occurrences = $balls->reduce(
                fn ($total, $item) => $total + $this->getCountOfBallNumber($item, $i),
                $INITIAL_TOTAL
            );

            $data[] = compact('number', 'occurrences');
        }

        return $data;
    }

    public function queryOccurrencesCount(int $ball, MegaSenaDataRequest $request)
    {
        $query = Game::selectRaw("bola_{$ball} as ball, COUNT(*) as count")
            ->groupBy("bola_{$ball}")
            ->orderByRaw("bola_{$ball} ASC");

        if ($request->input('month')) {
            $this->queryDate($query, $request->input('month'));
        }

        return $query;
    }

    public function queryDate($query, $date)
    {
        $date = Carbon::createFromFormat('Y-m', $date)->startOfMonth();
        $query->whereDate('date', '>', $date);
    }

    public function getDataFromAllBalls(MegaSenaDataRequest $request): Collection
    {
        $data = [];

        for ($i = 1; $i <= 6; $i++) {
            $data[] = $this->queryOccurrencesCount($i, $request)->get();
        }

        return collect($data);
    }
}
