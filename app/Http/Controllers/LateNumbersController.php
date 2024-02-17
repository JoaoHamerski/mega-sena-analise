<?php

namespace App\Http\Controllers;

use App\Actions\GetLateNumbersAction;
use App\Actions\GetNumbersAction;
use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class LateNumbersController extends Controller
{
    public function __invoke()
    {
        return GetLateNumbersAction::execute();
    }
}
