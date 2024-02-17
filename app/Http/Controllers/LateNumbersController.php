<?php

namespace App\Http\Controllers;

use App\Actions\GetLateNumbersByDaysAction;

class LateNumbersController extends Controller
{
    public function __invoke()
    {
        return GetLateNumbersByDaysAction::execute();
    }
}
