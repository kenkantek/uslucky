<?php

namespace App\Http\Controllers;

use Javascript;

class GameController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function getPowerball()
    {
        Javascript::put([
            '_powerball' => powerballNextTime(),
        ]);
        return view('games.powerball');
    }

}
