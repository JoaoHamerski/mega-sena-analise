<?php

namespace App\Traits;

use App\Http\Requests\MegaSenaDataRequest;
use Illuminate\Support\Arr;

trait MegaSenaHomeNumbers
{
    public function getNumbersData($numbers, MegaSenaDataRequest $request)
    {
        $numbers = collect($numbers);

        if ($request->boolean('sort')) {
            $numbers = $numbers->sortByDesc('occurrences');
        }

        return $numbers->values();
    }

    public function getNumberOccurrences(MegaSenaDataRequest $request)
    {
        $query = $this->queryGames($request);

        $numbers = Arr::map(range(1, 60), fn ($number) => [
            'number' => $number,
            'occurrences' => $this->countOccurrencesOfNumber($number, $query),
        ]);

        $numbersWithRelativeOccurrences = $this->appendRelativeOccurrences($numbers);

        return $this->getNumbersData($numbersWithRelativeOccurrences, $request);
    }

    public function appendRelativeOccurrences($numbers)
    {
        $metadata = $this->getMetadata($numbers);

        return Arr::map($numbers, fn ($item) => [
            ...$item,
            ...[
                'relative_occurrences' => $this->getRelativeOccurrence($item['occurrences'], $metadata)
            ]
        ]);
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

    public function countOccurrencesOfNumber(int $number, $query)
    {
        return $query->clone()->whereNumber($number)->count();
    }
}
