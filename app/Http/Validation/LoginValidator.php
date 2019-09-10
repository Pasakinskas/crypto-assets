<?php


namespace App\Http\Validation;


use Illuminate\Http\Request;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

trait loginValidator {
    use ProvidesConvenienceMethods;

    public function validateLoginData(Request $request) {
        $validatedBody = $this->validate($request, [
            "email" => "required|email",
            "password" => "required",
        ]);

        return $validatedBody;
    }
}
