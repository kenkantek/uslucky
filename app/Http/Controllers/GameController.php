<?php

namespace App\Http\Controllers;

class GameController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function getPowerball()
    {
        return view('games.powerball');
    }

}
