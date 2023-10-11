<?php

namespace App\Http\Controllers;

use App\Http\Requests\MegaSenaRequest;
use App\Traits\MegaSenaQueryTrait;
use Illuminate\Support\Facades\Cache;

class StatsOddEvenOccurrencesController extends Controller
{
    use MegaSenaQueryTrait;

    /**
     * Handle the incoming request.
     */
    public function __invoke(MegaSenaRequest $request)
    {
        $numbers = Cache::get('mega-sena:numbers');

        $odd = 0;
        $even = 0;

        $numbers->each(function ($item) use (&$odd, &$even) {
            if ($item['number'] % 2 === 0) {
                $even += $item['occurrences'];
            } else {
                $odd += $item['occurrences'];
            }
        });

        return compact('odd', 'even');
    }
}
