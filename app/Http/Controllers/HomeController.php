<?php

namespace App\Http\Controllers;

use App\Actions\GetNumbersAction;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke()
    {
        $numbers = GetNumbersAction::execute();

        Cache::put('mega-sena:numbers', $numbers);

        return Inertia::render('Home/TheHome', [
            'numbers' => $numbers,
        ]);
    }
}
