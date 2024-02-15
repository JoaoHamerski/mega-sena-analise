<?php

namespace App\Http\Controllers;

use App\Actions\GetNumbersAction;
use App\Models\Game;
use Inertia\Inertia;

class MegaSenaController extends Controller
{
    public function __invoke()
    {
        $numbers = GetNumbersAction::execute();
        $games = Game::query()->orderBy('concurso', 'desc')->get();

        return Inertia::render('Home/TheHome', [
            'numbers' => $numbers,
            'games' => $games
        ]);
    }
}
