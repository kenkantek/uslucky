<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\Admin\Settings\DepositRequest;
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

    public function getTransactions(Request $request)
    {
        // return $this->user->transactions()->with('status')->latest('updated_at')->paginate($take);
        $take = $request->take ?: 10;
        return User::find($request->id)
            ->transactions()->with('status')
            ->latest('updated_at')
            ->paginate($take)
            ->appends(['take' => $take]);
    }

    public function getOrders(Request $request)
    {
        $take = $request->take ?: 10;
        return User::find($request->id)
            ->orders()->with('status')
            ->latest()
            ->paginate($take)
            ->appends(['take' => $take]);
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
        $password           = User::findOrFail($id);
        $password->password = bcrypt($request->password);
        $password->save();
        return $password;
    }

    public function putActive($ids)
    {
        $ids = explode(',', $ids);
        foreach ($ids as $key => $id) {
            $user              = User::find($id);
            $user->active_code = null;
            $user->active      = 1;
            $user->save();
        }
        return $ids;
    }

    public function postDeposit(DepositRequest $request, $id)
    {
        $user          = User::findOrFail($id);
        $balance       = $user->balance; // prev
        $amount        = $request->amount;
        $balance_total = $balance + $amount;

        $transaction = $user->newTransaction($user)
            ->withType(1)
            ->withAmount($amount)
            ->withAmountPrev($balance)
            ->withAmountTotal($balance_total)
            ->withDescription($request->description)
            ->publish();

        // Transaction add status
        $status = $transaction->updateOrNewStatus()
            ->withStatus('succeeded')
            ->publish();

        $amount = $user->updateAmount($user->amount)
            ->withAmount($balance_total)
            ->publish();

        return $amount;

    }
}
