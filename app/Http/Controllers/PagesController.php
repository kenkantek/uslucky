<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('home');
    }
}
