<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function getResults(Request $request)
    {
        return response()->json(json_decode(curlGetUrl($request->all())));
    }
}
