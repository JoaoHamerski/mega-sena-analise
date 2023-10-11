<?php

namespace App\Http\Controllers;

use App\Http\Requests\MegaSenaRequest;
use App\Traits\MegaSenaNumbersTrait;
use App\Traits\MegaSenaQueryTrait;
use App\Traits\MegaSenaResultsTrait;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class MegaSenaController extends Controller
{
    use MegaSenaQueryTrait,
        MegaSenaNumbersTrait,
        MegaSenaResultsTrait;

    public function __invoke(MegaSenaRequest $request)
    {
        $numbers = $this->getNumberOccurrences($request);
        $results = fn () => $this->getResultsWithRelativeOccurrences($request, $numbers);

        $this->cacheNumbers($numbers);

        return Inertia::render(
            'Home/TheHome',
            [
                'numbers' => $numbers,
                'results' =>  Inertia::lazy($results),
            ]
        );
    }

    public function cacheNumbers($numbers)
    {
        Cache::put('mega-sena:numbers', $numbers);
    }
}
