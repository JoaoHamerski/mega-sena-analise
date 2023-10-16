<?php

namespace App\Http\Controllers;

use App\Http\Requests\MegaSenaRequest;
use App\Traits\MegaSenaNumbersTrait;
use App\Traits\MegaSenaQueryTrait;
use App\Traits\MegaSenaResultsTrait;
use Inertia\Inertia;

class MegaSenaController extends Controller
{
    use MegaSenaNumbersTrait,
        MegaSenaResultsTrait;

    public function __invoke(MegaSenaRequest $request)
    {
        $numbersCallback = fn () => $this->getNumbersWithOccurrences($request);
        $resultsCallback = fn () => $this->getResults($request);

        return Inertia::render(
            'Home/TheHome',
            [
                'numbers' => Inertia::lazy($numbersCallback),
                'results' =>  Inertia::lazy($resultsCallback),
            ]
        );
    }
}
