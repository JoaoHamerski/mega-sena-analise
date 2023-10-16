<?php

namespace App\Traits;

use App\Http\Requests\MegaSenaRequest;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait MegaSenaQueryTrait
{
    public function queryGames(MegaSenaRequest $request, Builder $query = null): Builder
    {
        $query = $query ?? Game::query();

        if ($request->filled('month')) {
            $this->queryDateByMonth($query, $request->month);
        }

        return $query;
    }

    public function queryDateByMonth($query, $month)
    {
        $date = Carbon::createFromFormat('Y-m', $month)->startOfMonth();

        $query->whereDate('date', '>', $date);
    }
}
