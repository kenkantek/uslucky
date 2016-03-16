<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TicketsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        return 'view page tickets';
    }
}
