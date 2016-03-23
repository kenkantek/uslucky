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
        'putContact' => 'put.contact',
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
        'getPayments'   => 'get.payments',
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

    // Orders
    $router->group(['as' => 'api::', 'prefix' => 'api'], function () use ($router) {
        $router->get('orders', [
            'as'   => 'get.orders',
            'uses' => 'User\OrderController@getOrders',
        ]);
        $router->get('orders/{order}', [
            'as'   => 'get.order',
            'uses' => 'User\OrderController@getOrder',
        ]);

    });
    $router->resource('orders', 'User\OrderController', ['only' => [
        'index', 'show',
    ]]);

    $router->controller('game', 'GameController', [
        'getPowerball' => 'game.powerball',
        'getPayment'   => 'game.get.payment',
    ]);

    $router->controller('powerball', 'Games\PowerballController', [
        'postPowerball' => 'post.powerball',
    ]);

});

$router->group([
    'prefix'     => 'admin',
    'namespace'  => 'Admin',
    'middleware' => ['web']], function () use ($router) {

    $router->get('login', [
        'as'   => 'admin.auth.login',
        'uses' => 'Auth\AuthController@getLogin',
    ]);

    $router->group(['middleware' => ['auth', 'active', 'admin']], function () use ($router) {

        //API
        $router->group(['as' => 'admin.', 'prefix' => 'api'], function () use ($router) {
            $router->get('contacts', [
                'as'   => 'get.contacts',
                'uses' => 'ContactController@getContacts',
            ]);

            $router->get('orders', [
                'as'   => 'get.orders',
                'uses' => 'OrdersController@getOrders',
            ]);

            $router->get('order/{order}', [
                'as'   => 'get.order',
                'uses' => 'OrdersController@getOrder',
            ]);

            $router->get('users', [
                'as'   => 'get.users',
                'uses' => 'UserController@getUsers',
            ]);

        });

        $router->resource('contact', 'ContactController', [
            'only' => ['index', 'show', 'update'],
        ]);

        $router->resource('users', 'UserController', [
            'only' => 'index',
        ]);

        $router->get('orders/prints', [
            'as'   => 'get.prints',
            'uses' => 'OrdersController@getPrints',
        ]);
        $router->resource('orders', 'OrdersController', [
            'only' => ['index', 'show'],
        ]);

        $router->resource('tickets', 'TicketsController', [
            'only' => 'index',
        ]);

        //NOTICE: Only bottom
        $router->controller('/', 'AdminController', [
            'getDashboard' => 'admin.dashboard',
        ]);

    });
});
