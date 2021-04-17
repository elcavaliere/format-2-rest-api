<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {

    echo 'New branch';

    \Illuminate\Support\Facades\Auth::attempt(['email' => 'elie', 'password' => 'ksdkd']);

    return $router->app->version();

});

$router->group(['prefix' => 'api', 'middleware' => 'auth:api'],function () use ($router){

    $router->get('/me','AuthController@me');
    $router->post('/logout','AuthController@logout');

    $router->get('/transactions','TransactionsController@index');
    $router->get('/transactions/{id}','TransactionsController@show');
    $router->post('/transactions/create','TransactionsController@store');
    $router->post('/transactions/{id}/cancel','TransactionsController@destroy');


    $router->get('/users/', 'UsersController@index');
    $router->get('/users/{id}', 'UsersController@show');
    $router->get('/users/{id}/balance', 'UsersController@balance');
    $router->get('/users/{id}/transactions', 'UsersController@transactions');

    
});

$router->group(['prefix' => 'api'], function () use ($router){

    $router->post('/register','AuthController@register');
    $router->post('/login','AuthController@login');

});
