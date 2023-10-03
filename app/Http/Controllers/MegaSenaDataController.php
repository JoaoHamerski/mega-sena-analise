<?php

namespace App\Http\Controllers;

use App\Http\Requests\MegaSenaDataRequest;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;

class MegaSenaDataController extends Controller
{

    public function __invoke(MegaSenaDataRequest $request)
    {
        $ballsData = $this->getDataFromAllBalls();
        $numbers = $this->mergeNumberOccurrences($ballsData);
        $metadata = $this->getMetadata($numbers);
        $formatted = $this->formatNumbers($numbers, $metadata, $request);

        return Inertia::render('Home/TheHome', [
            'numbers' => $formatted,
            'metadata' => $metadata
        ]);
    }

    public function formatNumbers(array $numbers, array $metadata, MegaSenaDataRequest $request): Collection
    {
        $formatted = collect();

        foreach ($numbers as $number => $occurrences) {
            $formatted->push([
                'number' => $number,
                'occurrences' => $occurrences,
                'relative_occurrence' => $this->getRelativeOccurrence($occurrences, $metadata)
            ]);
        }

        if ($request->input('sort')) {
            return $formatted->sortByDesc('occurrences')->values();
        }

        return $formatted;
    }

    public function getRelativeOccurrence($occurrences, $metadata)
    {
        $max = $metadata['max'];
        $min = $metadata['min'];

        return (($occurrences - $min) / ($max - $min)) * 100;
    }

    public function getMetadata(array $numbers)
    {
        $numbers = collect($numbers);

        return [
            'max' => $numbers->max(),
            'min' => $numbers->min()
        ];
    }

    public function mergeNumberOccurrences($balls): array
    {
        $data = [];

        for ($i = 1; $i <= 60; $i++) {
            $data[$i] = $balls->reduce(function ($total, $item) use ($i) {
                $item = $item->where('ball', $i);

                $count = $item->first()
                    ? $item->first()['count']
                    : 0;

                return $total + $count;
            }, 0);
        }

        return $data;
    }

    public function getDataFromAllBalls(): Collection
    {
        $data = [];

        for ($i = 1; $i <= 6; $i++) {
            $data[] = collect($this->getDataFromBall($i)->toArray());
        }

        return collect($data);
    }

    public function getDataFromBall(int $number): Collection
    {
        return Game::selectRaw("bola_{$number} as ball, COUNT(*) as count")
            ->groupBy("bola_{$number}")
            ->orderByRaw("bola_{$number} ASC")
            ->get();
    }
}
