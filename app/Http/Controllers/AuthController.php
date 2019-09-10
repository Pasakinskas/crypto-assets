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
    use loginValidator;

    public function authenticate(Request $request) {
        $loginData = $this->validateLoginData($request);
        try {
            $user = User::where('email', $loginData["email"])->first();
            if (!$user) {
                return new Response(["error:" => "Invalid email"], 404);
            }

            if (Hash::check($loginData["password"], $user->password)) {
                $key = env("JWT_SECRET");
                $payload = array(
                    "id" => $user->id,
                    "email" => $user->email
                );

                $jwt = JWT::encode($payload, $key);
                return [
                    "success:" => "true",
                    "token" => $jwt
                ];
            }

            return new Response(["error:" => "Invalid password"], 404);
        } catch(Exception $e)  {
            return new Response(["error:" => $e->getMessage()], 404);
        }
    }
}
