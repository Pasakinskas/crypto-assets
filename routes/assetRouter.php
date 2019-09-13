<?php

use App\Http\Controllers\AssetController;
use Illuminate\Http\Request;

$router->get('/assets', ['middleware' => 'auth', 'uses' => "AssetController@getAll"]);

$router->get('/assets/value', ['middleware' => 'auth', 'uses' => "AssetValueController@getAllValue"]);

$router->get('/assets/{id}', ['middleware' => 'auth', 'uses' => "AssetController@getById"]);

$router->get('/assets/{id}/value', ['middleware' => 'auth', 'uses' => "AssetValueController@getValueById"]);

$router->post('/assets', ['middleware' => 'auth', 'uses' => "AssetController@create"]);

$router->delete("/assets/{id}", ['middleware' => 'auth', 'uses' => "AssetController@deleteById"]);

$router->put("/assets/{id}", ['middleware' => 'auth', 'uses' => "AssetController@updateById"]);
