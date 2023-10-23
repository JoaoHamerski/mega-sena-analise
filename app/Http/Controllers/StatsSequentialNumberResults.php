<?php

namespace App\Http\Controllers;

use App\Http\Requests\MegaSenaRequest;
use App\Traits\MegaSenaQueryTrait;
use Illuminate\Support\Arr;

class StatsSequentialNumberResults extends Controller
{
    use MegaSenaQueryTrait;

    /**
     * Handle the incoming request.
     */
    public function __invoke(MegaSenaRequest $request)
    {
        $results = $this->queryGames($request)
            ->orderBy('date', 'DESC')
            ->get();

        $sequentialResults = Arr::mapWithKeys(range(1, 60), fn ($num) => ["num_{$num}" => 0]);

        foreach ($results as $index => $result) {
            $this->countNumberInNextResult($results, $index, $sequentialResults);
        }

        asort($sequentialResults);

        return $sequentialResults;
    }

    public function countNumberInNextResult($results, $index, &$sequentialResults)
    {
        $resultNumbers = $results->get($index)->numbers;
        $nextResult = $results->get($index + 1);

        if (!$nextResult) {
            return;
        }

        foreach ($resultNumbers as $num) {
            if (in_array($num, $nextResult->toArray())) {
                $sequentialResults["num_{$num}"]++;
            }
        }
    }
}
