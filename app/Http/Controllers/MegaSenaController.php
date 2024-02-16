<?php

namespace App\Http\Controllers;

use App\Actions\GetNumbersAction;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class MegaSenaController extends Controller
{
    public function __invoke()
    {
        $numbers = GetNumbersAction::execute();
        $games = Game::query()->orderBy('concurso', 'desc')->paginate(10);

        Cache::put('numbers', $numbers);

        return Inertia::render('Home/TheHome', [
            'numbers' => $numbers,
            'games' => GameResource::collection($games)
        ]);
    }
}
