<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
     */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest', ['except' => 'logout', 'getVerify', 'getReSendEmail']);
        \JavaScript::put([
            '_link' => [
                'account' => route('front::settings.account'),
            ],
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => 'required|email|max:255|unique:users',
            'password'   => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $active_code = str_random(30);
        $user        = User::create([
            'first_name'  => $data['first_name'],
            'last_name'   => $data['last_name'],
            'email'       => $data['email'],
            'password'    => bcrypt($data['password']),
            'active_code' => $active_code,
        ]);
        $user->assignRole('player');

        event(new UserCreated($user));

        return $user;
    }

    public function handleProviderCallback()
    {
        if (!empty($_REQUEST['error']) && ($_REQUEST['error'] == 'access_denied')) {
            return redirect()->route('front::auth.facebook');
        }
        $userfb = Socialite::driver('facebook')->user();

        if (User::where('email', '=', $userfb->email)->first()) {
            $checkUser = User::where('email', '=', $userfb->email)->first();
            Auth::login($checkUser);
            return redirect()->route('front::settings.account');
        }
        // $userfb           = $userfb->user;
        if ($userfb->email == null) {
            return redirect('register');
        }

        $user             = new User;
        $user->first_name = $userfb->user['first_name'];
        $user->last_name  = $userfb->user['last_name'];
        $user->email      = $userfb->user['email'];
        $user->avatar     = $userfb->avatar;
        $user->active     = 1;
        $user->save();

        Auth::login($user);
        return redirect()->route('front::settings.account');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')
            ->scopes(['email'])->redirect();
    }

    public function sendFailedLoginResponse()
    {
        return response(['message' => 'Your email or password does not match!'], 401);
    }
}
