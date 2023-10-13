<?php

namespace App\Traits;

use App\Http\Requests\MegaSenaRequest;
use Cache;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait MegaSenaResultsTrait
{
    public function getResults(MegaSenaRequest $request)
    {
        $numbers = Cache::get('mega-sena:numbers');

        $games = $this->queryGames($request)
            ->orderBy('date', 'desc')
            ->paginate()
            ->toArray();

        $games =  $this->appendOccurrencesToGameNumbers($games, $numbers);

        return $games;
    }

    public function appendOccurrencesToGameNumbers(array $games, $numbers)
    {
        $games['data'] = Arr::map($games['data'], function ($item) use ($numbers) {
            for ($i = 1; $i <= 6; $i++) {
                $number = $item["bola_{$i}"];

                $item["bola_{$i}"] = [
                    'number' => $number,
                    'relative_occurrences' => $this->findRelativeOccurrences($number, $numbers)
                ];
            }

            return $item;
        });

        return $games;
    }

    public function findRelativeOccurrences(int $searchNumber, Collection $numbers)
    {
        $number = $numbers->where('number', $searchNumber)->first();

        return $number['relative_occurrences'];
    }
}
