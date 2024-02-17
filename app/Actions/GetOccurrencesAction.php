<?php

namespace App\Actions;

use App\Models\Game;
use Illuminate\Support\Arr;

class GetOccurrencesAction
{
    public static function execute(): array
    {
        $range = range(1, 60);
        $occurrences = Arr::map(
            $range,
            fn ($num) => static::countNumberOccurrences($num)
        );

        return array_combine($range, $occurrences);
    }

    public static function countNumberOccurrences(int $num): int
    {
        return Game::query()->whereContainsNumber($num)->count();
    }
}
