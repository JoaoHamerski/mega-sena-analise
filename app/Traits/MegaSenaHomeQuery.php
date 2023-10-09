<?php

namespace App\Traits;

use Carbon\Carbon;

trait MegaSenaHomeQuery
{
    public function queryDateByMonth($query, $month)
    {
        $date = Carbon::createFromFormat('Y-m', $month)->startOfMonth();

        $query->whereDate('date', '>', $date);
    }
}
