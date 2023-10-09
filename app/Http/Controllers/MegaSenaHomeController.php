<?php

namespace App\Http\Controllers;

use App\Http\Requests\MegaSenaDataRequest;
use App\Models\Game;
use App\Traits\MegaSenaHomeQuery;
use Arr;
use Carbon\Carbon;
use Error;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Inertia\Inertia;
use Schema;
use Str;

class MegaSenaHomeController extends Controller
{
    use MegaSenaHomeQuery;

    protected $whereClauseBalls;

    public function __invoke(MegaSenaDataRequest $request)
    {
        $numbers = $this->getNumberOccurrences($request);

        return Inertia::render(
            'Home/TheHome',
            [
                'numbers' => $numbers
            ]
        );
    }

    public function getRelativeOccurrence($occurrences, $metadata)
    {
        $max = $metadata['max'];
        $min = $metadata['min'];

        if ($max === 0 && $min === 0) {
            return 0;
        }

        return (($occurrences - $min) / ($max - $min)) * 100;
    }

    public function getMetadata(array $numbers)
    {
        $numbers = collect($numbers);

        return [
            'max' => $numbers->pluck('occurrences')->max(),
            'min' => $numbers->pluck('occurrences')->min()
        ];
    }

    public function buildWhereClauseForBalls()
    {
        $columns = array_filter(
            Schema::getColumnListing('games'),
            fn ($column) => Str::contains($column, 'bola')
        );

        $this->whereClauseBalls = implode(" = ? or ", $columns) . " = ?";
    }

    public function countOccurrencesOfNumber(int $number, $query)
    {
        if (!$this->whereClauseBalls) {
            throw new Error("Where clause isn't set.");
        }

        $whereClause = '(' . Str::replace('?', $number, $this->whereClauseBalls) . ')';

        return $query->clone()->whereRaw($whereClause)->count();
    }

    public function queryGames(MegaSenaDataRequest $request, Builder $query = null)
    {
        $query = $query ?? Game::query();

        if ($request->filled('month')) {
            $this->queryDateByMonth($query, $request->month);
        }

        return $query;
    }

    public function appendRelativeOccurrences($numbers)
    {
        $metadata = $this->getMetadata($numbers);

        return Arr::map($numbers, fn ($item) => [
            ...$item,
            ...[
                'relative_occurrences' => $this->getRelativeOccurrence($item['occurrences'], $metadata)
            ]
        ]);
    }

    public function getData($numbers, MegaSenaDataRequest $request)
    {
        $numbers = collect($numbers);

        if ($request->boolean('sort')) {
            $numbers = $numbers->sortByDesc('occurrences');
        }

        return $numbers->values();
    }

    public function getNumberOccurrences(MegaSenaDataRequest $request)
    {
        $this->buildWhereClauseForBalls();

        $query = $this->queryGames($request);

        $numbers = Arr::map(range(1, 60), fn ($number) => [
            'number' => $number,
            'occurrences' => $this->countOccurrencesOfNumber($number, $query),
        ]);

        $numbersWithRelativeOccurrences = $this->appendRelativeOccurrences($numbers);


        return $this->getData($numbersWithRelativeOccurrences, $request);
    }
}
