<?php

namespace App\Actions;

use Illuminate\Support\Collection;

class GetNumbersAction
{
    public static function execute(array $occurrences = null, array $metadata = null): Collection
    {
        if (!$occurrences) {
            $occurrences = GetOccurrencesAction::execute();
        }

        if (!$metadata) {
            $metadata = GetMetadataAction::execute($occurrences);
        }

        return Collection::range(1, 60)->map(fn ($num) => [
            'number' => $num,
            'occurrences' => $occurrences[$num],
            'relative_occurrence' => self::getRelativeOccurrence($occurrences[$num], $metadata)
        ]);
    }

    public static function getRelativeOccurrence(int $numberOccurrences, array $metadata): float
    {
        $min = $metadata['occurrences']['min'];
        $max = $metadata['occurrences']['max'];

        $result = (($numberOccurrences - $min) / ($max - $min)) * 100;

        return round($result, 2);
    }
}
