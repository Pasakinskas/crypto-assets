<?php

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

$router->get('/assets', "AssetController@getAllAssets");

$router->get('/assets/{id}', "AssetController@getAssetById");

$router->post('/assets', "AssetController@createNewAsset");

$router->delete("/assets/{id}", "AssetController@deleteAssetById");

$router->put("/assets/{id}", "AssetController@updateAssetById");
