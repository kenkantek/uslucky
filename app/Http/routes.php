<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

$router->group(['as' => 'front::', 'middleware' => ['web']], function () use ($router) {
    $router->auth();

    $router->get('home', function () {
        return redirect()->route('front::settings.account');
    });

    $router->get('/', [
        'as'   => 'home',
        'uses' => 'PagesController@getIndex',
    ]);

    $router->get('about', [
        'as'   => 'about',
        'uses' => 'PagesController@about',
    ]);

    $router->get('auth/facebook', [
        'as'   => 'auth.facebook',
        'uses' => 'Auth\AuthController@redirectToProvider',
    ]);

    $router->get('auth/facebook/callback', [
        'as'   => 'auth.social.confirm',
        'uses' => 'Auth\AuthController@handleProviderCallback',
    ]);

    $router->controller('page', 'PagesController', [
        'getAbout'   => 'about',
        'getContact' => 'contact',
    ]);

    $router->controller('settings', 'User\SettingsController', [
        'getAccount' => 'settings.account',
        'getPayment' => 'settings.payment',
        'getWinning' => 'settings.winning',
    ]);

    $router->controller('account', 'User\AccountController', [
        'putEditAccount'   => 'account.put.account',
        'postChangeAvatar' => 'account.avatar',
        'putChangePass'    => 'account.put.changepass',
        'getReSendEmail'   => 'register.resend.email',
        'getThank'         => 'register.thank',
        'getVerify'        => 'register.verify',
        'getAccount'       => 'get.account',
    ]);

    $router->controller('payment', 'User\PaymentController', [
        'putPayment'    => 'put.payment',
        'postPayment'   => 'post.payment',
        'deletePayment' => 'delete.payment',
        'postCharge'    => 'post.charge',
        'getHistory'    => 'payment.history',
    ]);

    $router->controller('winning', 'User\WinningController', [
        'postCharge' => 'post.charge',
        'postClaim'  => 'post.claim',
    ]);

    $router->controller('transaction', 'User\TransactionController', [
        'getTransactions' => 'get.transaction',
        'putCancel'       => 'put.cancel.transaction',
    ]);

    $router->controller('game', 'GameController', [
        'getPowerball' => 'game.powerball',
    ]);

    $router->controller('powerball', 'Games\PowerballController', [
        'postPowerball' => 'post.powerball',
    ]);
});

$router->group(['prefix' => env('DIR_ADMIN', 'admin'), 'as' => 'backend::', 'middleware' => ['web', 'auth', 'active', 'admin']], function () use ($router) {

    $router->controller('tickets', 'Admin\TicketsController');

    //NOTICE: Only bottom
    $router->controller('/', 'Admin\AdminController');
});
