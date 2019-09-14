<?php


namespace App\Http\Controllers;


use App\Http\Validation\loginValidator;
use App\Models\User;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    protected $loginValidator;

    public function __construct(LoginValidator $loginValidator) {
        $this->loginValidator = $loginValidator;
    }

    public function authenticate(Request $request) {
        $loginData = $this->loginValidator->validateLoginData($request);
        $user = User::where('email', $loginData["email"])->first();
        if (!$user) {
            return new Response(["error" => "Invalid email or password"], 401);
        }

        if (Hash::check($loginData["password"], $user->password)) {
            $key = env("JWT_SECRET");
            $payload = array(
                "id" => $user->id,
                "email" => $user->email
            );

            $jwt = JWT::encode($payload, $key);
            return [
                "success" => "true",
                "token" => $jwt
            ];
        }

        return new Response(["error" => "Invalid email or password"], 404);
    }
}
