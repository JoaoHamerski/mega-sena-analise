<?php

namespace App\Http\Controllers;

use App\Actions\GetContestsAction;
use App\Http\Resources\ContestResource;
use Illuminate\Http\Request;

class GetContestsController extends Controller
{
    public function __invoke()
    {
        $contests = GetContestsAction::execute();

        return ContestResource::collection($contests);
    }
}
