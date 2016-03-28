<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function show(User $users)
    {
        \Javascript::put([
            'user_id'    => $users->id,
            '_countries' => file_get_contents(storage_path('countries.json')),
        ]);
        return view('admin.users.show', compact('users'));
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);
        foreach ($ids as $key => $id) {
            if (Auth::user()->id == $id) {
                return response(['message' => 'abc'], 500);
            }
            User::destroy($id);
        }
        return $ids;
    }

    public function getUsers(Request $request)
    {
        $keyword = $request->keyword ?: '';
        $take    = $request->take ?: 10;
        return User::search($keyword)
            ->latest()
            ->paginate($take)
            ->appends(['take' => $take, 'keyword' => $keyword]);
    }

    public function getUser(User $user)
    {
        return $user;
    }
}
