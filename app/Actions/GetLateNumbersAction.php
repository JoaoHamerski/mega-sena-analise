<?php

namespace App\Actions;

use App\Models\Contest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class GetLateNumbersAction
{
    public static function execute(): Collection
    {
        $totalContests = Contest::count();
        $numbers =  Cache::get('mega-sena:numbers', fn () => GetNumbersAction::execute());

        return $numbers->map(function ($number) use ($totalContests) {
            $contest = static::getLastContestOfNumber($number['number']);

            return [
                ...$number,
                'last_contest' => $contest,
                'late_by_contests' => $totalContests - $contest->concurso
            ];
        });
    }

    public static function getLastContestOfNumber(int $number): Contest
    {
        return Contest::whereContainsNumber($number)
            ->orderBy('data', 'desc')
            ->first();
    }
}
