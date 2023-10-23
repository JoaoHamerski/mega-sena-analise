<?php

namespace App\Http\Controllers;

use App\Http\Requests\MegaSenaRequest;
use App\Traits\MegaSenaNumbersTrait;
use App\Traits\MegaSenaResultsTrait;
use Inertia\Inertia;

class MegaSenaController extends Controller
{
    use MegaSenaNumbersTrait,
        MegaSenaResultsTrait;

    public function __invoke(MegaSenaRequest $request)
    {
        $numbers = Inertia::lazy(fn () => $this->getNumbersWithOccurrences($request));
        $results = Inertia::lazy(fn () => $this->getResults($request));

        return Inertia::render(
            'Home/TheHome',
            compact('numbers', 'results')
        );
    }
}
