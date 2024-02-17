<?php

namespace App\Actions;

use Illuminate\Support\Collection;

class GetLateNumbersByDaysAction
{
    public static function execute(int $lateByDays = 60): array
    {
        $lateNumbers = GetLateNumbersAction::execute();

        return [
            'data' => static::filterByLateByDays($lateNumbers, $lateByDays),
            'late_by_days' => $lateByDays
        ];
    }

    public static function filterByLateByDays(Collection $lateNumbers, int $lateBy): Collection
    {
        $maxDate = now()->subDays($lateBy);

        $filteredLateNumbers = $lateNumbers->filter(
            fn ($number) => $number['last_game']['data'] < $maxDate
        );

        return $filteredLateNumbers->values();
    }
}
