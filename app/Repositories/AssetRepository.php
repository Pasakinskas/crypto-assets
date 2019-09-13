<?php


namespace App\Repositories;


use App\Http\Validation\AssetValidator;
use App\Models\Asset;

class AssetRepository {

    protected $validator;

    public function __construct(AssetValidator $validator) {
        $this->validator = $validator;
    }

    public function getAllUserAssets($userId) {
        return Asset::where("user_id", $userId)->get();
    }

    public function getUserAssetById($userId, $assetId) {
        return Asset::where([
            "user_id" => $userId,
            "id" => $assetId
        ])->get();
    }

    public function deleteUserAssetById($userId, $assetId) {
        return Asset::where([
            "user_id" => $userId,
            "id" => $assetId
        ])->delete();
    }

    public function createNewAsset($request, $userId) {
        $asset = $this->validator->validateAsset($request);
        $asset["user_id"] = $userId;
        $asset->save();
        return $asset;
    }

    public function updateAsset($request, $assetId, $userId) {
        $newAsset = $this->validator->validateAsset($request);
        $oldAsset = Asset::where([
                "user_id" => $userId,
                "id" => $assetId
            ]);

        $oldAsset->update([
            "label" => $newAsset["label"],
            "currency" => $newAsset["currency"],
            "value" => $newAsset["value"]
        ]);

        return $oldAsset->get();
    }
}
