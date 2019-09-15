<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{

    protected $auth;

    public function __construct(Auth $auth) {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next) {
        return !$request->user()
            ? response(["error" => "invalid username or password"], 403)
            : $next($request);
    }
}
