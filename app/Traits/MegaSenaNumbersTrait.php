<?php

namespace App\Traits;

use App\Http\Requests\MegaSenaRequest;
use Illuminate\Support\Collection;

trait MegaSenaNumbersTrait
{
    use MegaSenaQueryTrait,
        MegaSenaMetadataTrait;

    public function getNumbersWithOccurrences(MegaSenaRequest $request)
    {
        $query = $this->queryGames($request);

        $numbers = Collection::range(1, 60)->map(fn ($number) => [
            'number' => $number,
            'occurrences' => $this->countOccurrences($number, $query),
        ]);

        $numbers = $this->appendRelativeOccurrences($numbers, $this->getMetadata($numbers));

        return $numbers;
    }

    public function getRelativeOccurrence($occurrences, $metadata)
    {
        $max = $metadata['max'];
        $min = $metadata['min'];

        if ($max === 0 && $min === 0) {
            return 0;
        }

        $result = (($occurrences - $min) / ($max - $min)) * 100;

        return (float) number_format($result, 2, '.', '');
    }

    public function appendRelativeOccurrences(Collection $numbers, $metadata)
    {
        return $numbers->map(fn ($item) => [
            ...$item,
            ...[
                'relative_occurrences' => $this->getRelativeOccurrence($item['occurrences'], $metadata)
            ]
        ]);
    }

    public function countOccurrences(int $number, $query)
    {
        return $query
            ->clone()
            ->whereNumber($number)
            ->count();
    }
}
