<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait MegaSenaNumbersRelativeTrait
{
    public function getMetadata(array|Collection $numbers)
    {
        $occurrences = $numbers instanceof Collection
            ? $numbers->pluck('occurrences')
            : collect($numbers)->pluck('occurrences');

        return [
            'max' => $occurrences->max(),
            'min' => $occurrences->min()
        ];
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
}
