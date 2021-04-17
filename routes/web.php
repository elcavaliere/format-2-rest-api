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
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router){

    $router->get('/transactions','TransactionsController@index');

    $router->get('/transactions/{id}','TransactionsController@show');

    $router->post('/transactions/create','TransactionsController@store');

    $router->post('/transactions/{id}/cancel','TransactionsController@destroy');


    $router->get('/users/', 'UsersController@index');

    $router->get('/users/{id}', 'UsersController@show');

    $router->get('/users/{id}/balance', 'UsersController@balance');

    $router->get('/users/{id}/transactions', 'UsersController@transactions');

});
