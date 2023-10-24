<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Http\Requests\MegaSenaRequest;
use App\Traits\MegaSenaNumbersTrait;
use Illuminate\Support\Facades\Cache;

class StatsOddEvenOccurrencesController extends Controller
{
    use MegaSenaNumbersTrait;

    /**
     * Handle the incoming request.
     */
    public function __invoke(MegaSenaRequest $request)
    {
        $numbers = Cache::get('mega-sena:numbers');

        $odd = 0;
        $even = 0;

        $numbers->each(function ($item) use (&$odd, &$even) {
            if (AppHelper::isEven($item['number'])) {
                $even += $item['occurrences'];
            } else {
                $odd += $item['occurrences'];
            }
        });

        return compact('odd', 'even');
    }
}
