<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\PasswordRequest;
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

    public function update(AccountRequest $request, $id)
    {
        $user             = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->phone      = $request->phone;
        $user->birthday   = $request->birthday;
        $user->address    = $request->address;
        $user->country    = $request->country;
        $user->state      = $request->state;
        $user->city       = $request->city;
        $user->zipcode    = $request->zipcode;
        $user->save();

        return $user;
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

    public function postChangeAvatar(AvatarRequest $request, $id)
    {
        $avatar     = User::findOrFail($id);
        $path_image = 'uploads/avatar/';

        if (\File::exists($avatar->avatar)) {
            \File::delete($avatar->avatar);
        }

        $file  = $request->file('avatar');
        $image = time() . '-' . $file->getClientOriginalName();
        $file->move($path_image, $image);
        $avatar->avatar = $path_image . $image;

        $avatar->save();
        return $avatar;
    }

    public function putChangePass(PasswordRequest $request, $id)
    {
        $password = User::findOrFail($id);
        if (\Hash::check($request->old_password, $password->password)) {
            $password->password = bcrypt($request->password);
            $password->save();

            return $password;

        } else {
            return response(['old_password' => 'Your old password incorrect!'], 401);
        }
    }

}
