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

/*
 *
 * UNAUTHENTICATED ROUTES
 *
 */
$router->group(['prefix' => '/api/v1'], function( $router ) {
        $router->post( '/login', 'AuthController@login');
        $router->post( '/register', 'AuthController@register' );
    }
);

$router->group(['prefix' => '/api/v1/posts'], function( $router ) {
    $router->get( '/', 'PostController@index' );
    $router->get( '/{id}', 'PostController@show' );
});

/*
 *
 * AUTHENTICATED ROUTES
 *
 */
$router->group(
  [
    'prefix' => '/api/v1',
    'middleware' => 'auth',
  ], function( $router ) {
        $router->post( '/logout', 'AuthController@logout' );
        $router->get( '/refresh', 'AuthController@refresh' );
        $router->post( '/refresh', 'AuthController@refresh' );
});


$router->group(
    [
        'prefix' => '/api/v1/posts',
        'middleware' => 'auth',
    ], function( $router ) {
    $router->post( '/', 'PostController@store' );
    $router->put( '/{id}', 'PostController@update' );
    $router->delete( '/{id}', 'PostController@destroy' );
});

$router->group(
    [
        'prefix' => '/api/v1/posts',
        'middleware' => 'auth',
    ], function( $router ) {
    $router->post( '/{post_id}/comments', 'CommentController@store' );
    $router->put( '/{post_id}/comments/id', 'CommentController@update' );
    $router->delete( '/comments/{post_id}', 'CommentController@destroy' );
});

