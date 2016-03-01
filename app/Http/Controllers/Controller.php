<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $user;

    public function __construct()
    {
        $this->user = auth()->user();
        \JavaScript::put([
            '_token' => csrf_token(),
            '_user'  => ['isLogin' => !!$this->user, 'level' => $this->user ? $this->user->roles() : 0],
        ]);
    }
}
