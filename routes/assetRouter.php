<?php

// $router->get('/assets', ['middleware' => 'auth', "AssetController@getAllAssets"]);

use App\Http\Controllers\AssetController;
use Illuminate\Http\Request;

$router->get('/assets', ['middleware' => 'auth', 'uses' => "AssetController@getAllAssets"]);

$router->get('/assets/{id}', "AssetController@getAssetById");

$router->post('/assets', "AssetController@createNewAsset");

$router->delete("/assets/{id}", "AssetController@deleteAssetById");

$router->put("/assets/{id}", "AssetController@updateAssetById");
