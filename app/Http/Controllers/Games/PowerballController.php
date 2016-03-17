<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class PowerballController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function postPowerball(Request $request)
    {
        return $request->all();
        return DB::transaction(function () {

        });
    }
}
