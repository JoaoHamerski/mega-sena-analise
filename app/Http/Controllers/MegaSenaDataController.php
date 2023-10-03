<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MegaSenaDataController extends Controller
{
    public function __invoke()
    {
        $ballsData = $this->getDataFromAllBalls();
        $numbers = $this->mergeNumberOcurrences($ballsData);
        $metadata = $this->getMetadata($numbers);
        $formatted = $this->formatNumbers($numbers, $metadata);

        return Inertia::render('Home/TheHome', [
            'numbers' => $formatted,
            'metadata' => $metadata
        ]);
    }

    public function formatNumbers(array $numbers, array $metadata): Collection
    {
        $formatted = collect();

        foreach ($numbers as $number => $occurences) {
            $formatted->push([
                'number' => $number,
                'occurences' => $occurences,
                'relative_occurence' => $this->getRelativeOccurence($occurences, $metadata)
            ]);
        }

        return $formatted;
    }

    public function getRelativeOccurence($occurences, $metadata)
    {
        $max = $metadata['max'];
        $min = $metadata['min'];

        return (($occurences - $min) / ($max - $min)) * 100;
    }

    public function getMetadata(array $numbers)
    {
        $numbers = collect($numbers);

        return [
            'max' => $numbers->max(),
            'min' => $numbers->min()
        ];
    }

    public function mergeNumberOcurrences($balls): array
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
            ->whereBetween('date', ['2022-01-01', '2024-01-01'])
            ->groupBy("bola_{$number}")
            ->orderByRaw("bola_{$number} ASC")
            ->get();
    }
}
