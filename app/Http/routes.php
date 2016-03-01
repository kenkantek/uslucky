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

    $router->get('/', [
        'as'   => 'home',
        'uses' => 'PagesController@index',
    ]);

    $router->controller('page', 'PagesController');
});
