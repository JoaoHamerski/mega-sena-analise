<?php

namespace App\Http\Controllers;

use App\Http\Requests\MegaSenaDataRequest;
use App\Traits\MegaSenaHomeNumbers;
use App\Traits\MegaSenaHomeQuery;
use App\Traits\MegaSenaHomeResults;
use Illuminate\Support\Collection;
use Inertia\Inertia;

class MegaSenaHomeController extends Controller
{
    use MegaSenaHomeQuery,
        MegaSenaHomeNumbers,
        MegaSenaHomeResults;

    public function __invoke(MegaSenaDataRequest $request)
    {
        $numbers = $this->getNumberOccurrences($request);
        $results = fn () => $this->getResultsWithRelativeOccurrences($request, $numbers);

        return Inertia::render(
            'Home/TheHome',
            [
                'numbers' => $numbers,
                'results' =>  Inertia::lazy($results),
            ]
        );
    }

    public function getMetadata(array|Collection $numbers)
    {
        $occurrences = $numbers instanceof Collection
            ? $numbers->pluck('occurrences')
            : collect($numbers)->pluck('occurrences');

        return [
            'max' => $occurrences->max(),
            'min' => $occurrences->min()
        ];
    }
}
