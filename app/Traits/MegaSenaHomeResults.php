<?php

namespace App\Traits;

use App\Http\Requests\MegaSenaDataRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait MegaSenaHomeResults
{
    public function getResults(MegaSenaDataRequest $request, Collection $numbers)
    {
        $games = $this->queryGames($request)
            ->orderBy('date', 'desc')
            ->paginate()
            ->toArray();

        $games =  $this->appendOccurrencesToGameNumbers($games, $numbers);

        return $games;
    }

    public function getRelativeOccurrencesOfNumber(int $number, Collection $numbers)
    {
        return $numbers->where('number', $number)->first()['relative_occurrences'];
    }

    public function appendOccurrencesToGameNumbers(array $games, Collection $numbers)
    {
        $games['data'] = Arr::map($games['data'], function ($item) use ($numbers) {
            for ($i = 1; $i <= 6; $i++) {
                $number = $item["bola_{$i}"];

                $item["bola_{$i}"] = [
                    'number' => $number,
                    'relative_occurrences' => $this->getRelativeOccurrencesOfNumber($number, $numbers)
                ];
            }

            return $item;
        });

        return $games;
    }
}
