<?php

namespace App\Actions;

use App\Http\Resources\GameResource;
use App\Models\Game;

class GetGamesAction
{
    public static function execute()
    {
        $games = Game::query()
            ->orderBy('concurso', 'desc')
            ->paginate(10);

        return GameResource::collection($games);
    }
}
