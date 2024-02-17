<?php

namespace App\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class GetNumbersAction
{
    protected $numbers;

    public static function execute(): Collection
    {
        $numbers = static::getNumbers();

        static::cacheNumbers($numbers);

        return static::getNumbers();
    }

    public static function getNumbers(): Collection
    {
        $occurrences = GetOccurrencesAction::execute();
        $metadata = GetMetadataAction::execute($occurrences);

        return Collection::range(1, 60)->map(fn ($num) => [
            'number' => $num,
            'occurrences' => $occurrences[$num],
            'relative_occurrence' => self::getRelativeOccurrence($occurrences[$num], $metadata)
        ]);
    }

    public static function cacheNumbers(Collection $numbers): void
    {
        Cache::put('mega-sena:numbers', $numbers);
    }

    public static function getRelativeOccurrence(int $numberOccurrences, array $metadata): float
    {
        $min = $metadata['occurrences']['min'];
        $max = $metadata['occurrences']['max'];

        $result = (($numberOccurrences - $min) / ($max - $min)) * 100;

        return round($result, 2);
    }
}
