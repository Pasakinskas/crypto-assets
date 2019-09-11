<?php

namespace App\Providers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use UnexpectedValueException;

class AuthServiceProvider extends ServiceProvider
{

    public function register() {
        //
    }

    public function boot() {
        $this->app['auth']->viaRequest('api', function ($request) {
            try {
                $token = $request->header("token");
                $decoded = JWT::decode($token, env("JWT_SECRET"), array("HS256"));
                $decodedArray = (array) $decoded;
            } catch (UnexpectedValueException $e) {
                return null;
            }

            $user = User::find($decodedArray["id"]);
            return $user ? $user : null;
        });
    }
}
