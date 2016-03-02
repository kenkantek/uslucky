<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\AvatarRequest;



class AccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function putEditAccount(AccountRequest $request)
    {
        $user = $this->user;

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->address = $request->address;
        $user->county = $request->county;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zipcode = $request->zipcode;

        $user->save();

        return $user;
    }

    public function postChangeAvatar(AvatarRequest $request)
    {
        $avatar = $this->user;
        $path_image = 'uploads/avatar/';

        if (\File::exists($avatar->avatar))
        {
            \File::delete($avatar->avatar);
        }

        $file = $request->file('avatar');
        $image = time().'-'.$file->getClientOriginalName();
        $file->move($path_image,$image);
        $avatar->avatar = $path_image.$image;

        $avatar->save();
        return $avatar;
    }
}
