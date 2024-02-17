<?php

namespace App\Http\Controllers;

use App\Actions\GetGamesAction;
use App\Actions\GetNumbersAction;
use App\Http\Resources\GameResource;
use App\Models\Game;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        $numbers = GetNumbersAction::execute();
        $games = GetGamesAction::execute();

        Cache::put('mega-sena:numbers', $numbers);

        return Inertia::render('Home/TheHome', [
            'numbers' => $numbers,
            'games' => $games
        ]);
    }
}
