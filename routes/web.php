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


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');

    $router->get('/products', 'ProductController@indexWithComments');
    $router->get('/products/{id}', 'ProductController@showWithComments');
    $router->post('/products', 'ProductController@store');

    $router->post('/products/{id}/comments', 'CommentController@store');

    $router->post('/products/{id}/like', 'LikeController@likeProduct');

    $router->post('/comments/{id}/like', 'LikeController@likeComment');

});

