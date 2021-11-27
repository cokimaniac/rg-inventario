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
    //return $router->app->version();
    return response()->json([
        "message" => "RG Inventory",
        "version" => 0.1
    ]);
});

$router->post("/user/signup", ["uses" => "UserController@signup"]);
$router->post("/user/login", ["uses" => "UserController@login"]);

// protected routes
$router->group(["middleware" => "auth"], function () use ($router) {
    $router->get("/user/list", ["uses" => "UserController@list"]);
    $router->get("/inventory", ["uses" => "InventarioController@list"]);
    $router->post("/inventory", ["uses" => "InventarioController@create"]);
});
