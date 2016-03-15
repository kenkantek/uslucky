<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->middleware('auth');
    }

    public function getIndex()
    {
        return view('home');
    }

    public function getAbout()
    {
        return view('page.about');
    }

    public function getContact()
    {
        return 'contact';
    }
}
