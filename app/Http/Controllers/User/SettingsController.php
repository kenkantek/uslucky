<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SettingsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
        \JavaScript::put([
            '_api' => [
                'user' => route('front::settings.api.account'),
                'put_account' => route('front::settings.put.account'),
                'put_avatar' => route('front::settings.avatar')
            ]
        ]);
    }

    public function getAccount()
    {
        return view('user.setings.account');
    }

    public function getApiAccount()
    {
        return $this->user;
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

    public function postChangeAvatar(Request $request)
    {
        $avatar = $this->user;

        $file = $request->file('avatar');
        $image = $file->getClientOriginalName();
        $path_image = 'uploads/avatar/';
        $file->move($path_image,$image);

        $avatar->avatar = $path_image.$image;

        $avatar->save();
    }
}
