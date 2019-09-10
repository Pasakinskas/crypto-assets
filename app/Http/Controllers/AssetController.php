<?php


namespace App\Http\Controllers;


use App\Http\Validation\AssetValidator;
use App\Models\Asset;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AssetController extends Controller {

    use AssetValidator;

    // $request->user() is the authenticated user
    public function getAllAssets() {
//        $user = new User([
//            "name" => "barry",
//            "email" => "testemail@email.com",
//        ]);
//
//        $user->password = Hash::make("testemail");
//        $user->save();

        return Asset::all();
    }

    public function getAssetById($id) {
        try {
            $asset = Asset::findOrFail($id);
            return new Response($asset, 200);
        } catch (Exception $e) {
            return new Response(["error" => $e->getMessage()], 404);
        }

    }

    public function deleteAssetById($id) {
        try {
            $asset = Asset::findOrFail($id);
            $asset->delete();
            return new Response([], 204);
        } catch (Exception $e) {
            return new Response(["error" => $e->getMessage()], 404);
        }
    }

    public function updateAssetById(Request $request, $id) {
        try {
            $newAsset = $this->validateAsset($request);
            $assetToUpdate = Asset::findOrFail($id);
            $assetToUpdate->update([
                "label" => $newAsset["label"],
                "currency" => $newAsset["currency"],
                "value" => $newAsset["value"],
                "user_id" => $newAsset["user_id"]
            ]);

            return new Response($assetToUpdate);
        } catch (Exception $e) {
            return new Response($e, 404);
        }
    }

    public function createNewAsset(Request $request) {
        try {
            $asset = $this->validateAsset($request);
            $asset->save();

            return new Response($asset, 201);
        } catch(Exception $e) {
            return new Response(["error" => $e->getMessage()], 400);
        }
    }
}
