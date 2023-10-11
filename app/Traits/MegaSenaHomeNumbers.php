<?php

namespace App\Traits;

use App\Http\Requests\MegaSenaDataRequest;
use Illuminate\Support\Arr;

trait MegaSenaHomeNumbers
{
    use MegaSenaHomeNumbersRelative;

    public function getNumberOccurrences(MegaSenaDataRequest $request)
    {
        $query = $this->queryGames($request);

        $numbers = Arr::map(range(1, 60), fn ($number) => [
            'number' => $number,
            'occurrences' => $this->countOccurrencesOfNumber($number, $query),
        ]);

        $numbersWithRelativeOccurrences = $this->appendRelativeOccurrences($numbers);

        return $this->applyFilters($numbersWithRelativeOccurrences, $request);
    }

    public function applyFilters($numbers)
    {
        $numbers = collect($numbers);

        return $numbers->values();
    }

    public function countOccurrencesOfNumber(int $number, $query)
    {
        return $query->clone()->whereNumber($number)->count();
    }
}
