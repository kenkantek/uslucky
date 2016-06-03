<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Image;
use App\Models\User;
use Hash;
use Mail;

class AccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => ['getThank', 'getVerify']]);
        $this->middleware('active', ['only' => 'getReSendEmail']);
    }

    public function getAccount()
    {
        return $this->user;
    }

    public function putEditAccount(AccountRequest $request)
    {
        $user = $this->user;

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

    public function postChangeAvatar(AvatarRequest $request)
    {
        $user = $this->user;
        Image::deleteImage($user->avatar);
        $storeFile = Image::setDir('uploads/avatar')
            ->fromForm($request->file('avatar'));
        $user->avatar = $storeFile->name;
        $user->save();

        return $user;
    }

    public function putChangePass(PasswordRequest $request)
    {
        $password = $this->user;
        if (Hash::check($request->old_password, $password->password)) {
            $password->password = bcrypt($request->password);
            $password->save();

            return $password;

        } else {
            return response(['old_password' => 'Your old password incorrect!'], 401);
        }
    }

    public function getVerify($active_code)
    {
        $user = User::whereActiveCode($active_code)->first();
        if (!$user) {

            return redirect()->route('front::settings.account');

        } else {
            $user->active_code = null;
            $user->active      = 1;
            $user->save();
            $flash_mes = 'verify';
            return view('user.verify', compact('flash_mes'));
        }

    }

    public function sendFailedLoginResponse()
    {
        return response(['message' => 'Your email or password does not match!'], 401);
    }

    public function getThank()
    {
        $flash_mes = 'success';

        return view('user.verify', compact('flash_mes'));
    }

    public function getReSendEmail()
    {
        if ($this->user->active == 1) {

            return redirect()->route('front::settings.account');

        } else {

            $user = $this->user;

            Mail::send('mail.verify', ['event' => $user], function ($message) use ($user) {
                $message->from(env('MAIL_FROM'), env('MAIL_FROM_NAME'));
                $message->to($user->email)->subject('Verify your email address');
            });

            $flash_mes = 'resent';

            return view('user.verify', compact('flash_mes'));
        }
    }
}
