<?php


namespace App\Http\Validation;


use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class LoginValidator {
    use ProvidesConvenienceMethods;

    //TODO: Sanitize user input
    private function sanitizeInput(){}

    public function validateLoginData(Request $request) {
        $validatedBody = $this->validate($request, [
            "email" => "required|email",
            "password" => "required",
        ]);

        return $validatedBody;
    }
}
