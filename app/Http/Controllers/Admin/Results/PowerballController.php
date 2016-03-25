<?php

namespace App\Http\Controllers\Admin\Results;

use App\Http\Controllers\Controller;

class PowerballController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.results.powerball.index');
    }
}
