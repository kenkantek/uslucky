<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);
        return $ids;
    }

    public function getUsers(Request $request)
    {
        $take         = $request->take;
        return $users = User::latest()->paginate($take);
    }
}
