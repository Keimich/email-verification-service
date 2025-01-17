<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => "/api/user"], function () use ($router) {
    $router->get("/{id}", "UsersController@get");
    $router->post("/", "UsersController@store");
    $router->put("/{id}", "UsersController@update");
    $router->delete("/{id}", "UsersController@destroy");
});
