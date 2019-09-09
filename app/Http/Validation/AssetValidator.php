<?php


namespace App\Http\Validation;


use App\Models\Asset;
use Illuminate\Http\Request;
use Exception;

use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

trait AssetValidator {
    use ProvidesConvenienceMethods;

    public function validateAsset(Request $request) {
        $validatedBody = $this->validate($request, [
            "label" => "required",
            "currency" => "required",
            "value" => "required|numeric|min:0",
            "user_id" => "required|numeric"
        ]);

        if (CurrencyEnum::isValid($validatedBody["currency"])) {
            return new Asset($validatedBody);
        } else {
            Throw new Exception("Provided currency fails enum type validation");
        }
    }
}
