<?php


namespace App\Http\Validation;


use App\Http\Validation\Components\CurrencyEnum;
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

        if (CurrencyEnum::isValid($validatedBody["currency"])) {
            return new Asset($validatedBody);
        } else {
            Throw new Exception("Provided currency fails validation");
        }
    }
}
