<?php

namespace App\Http\Controllers;

use App\Actions\GetMetadataAction;
use App\Actions\GetNumbersAction;
use App\Actions\GetOccurrencesAction;
use App\Models\Game;
use Inertia\Inertia;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

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
