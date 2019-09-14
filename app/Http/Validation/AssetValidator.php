<?php


namespace App\Http\Validation;


use App\Http\Validation\Components\CryptoCurrencyEnum;
use App\Models\Asset;
use Illuminate\Http\Request;
use Exception;

use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class AssetValidator {
    use ProvidesConvenienceMethods;

    public function validateAsset(Request $request) {
        $validatedBody = $this->validate($request, [
            "label" => "required",
            "currency" => "required",
            "value" => "required|numeric|min:0",
        ]);

        return CryptoCurrencyEnum::isValid($validatedBody["currency"]) ?
         new Asset($validatedBody) : null;
    }
}
