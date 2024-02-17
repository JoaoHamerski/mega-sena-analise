<?php

namespace App\Actions;

use App\Http\Resources\ContestResource;
use App\Models\Contest;

class GetContestsAction
{
    public static function execute()
    {
        $contests = Contest::query()
            ->orderBy('concurso', 'desc')
            ->paginate(10);

        return $contests;
    }
}
