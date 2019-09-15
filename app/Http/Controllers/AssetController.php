<?php


namespace App\Http\Controllers;


use App\Repositories\AssetRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AssetController extends Controller {

    protected $assets;

    public function __construct(AssetRepository $assets) {
        $this->assets = $assets;
    }

    public function getAll(Request $request) {
        $userId = $request->user()["id"];
        return $this->assets->getAllUserAssets($userId);
    }

    public function getById(Request $request, $id) {
        $userId = $request->user()["id"];
        $asset = $this->assets->getUserAssetById($userId, $id);
        if ($asset) {
            return new Response($asset, 200);
        } else {
            return new Response("", 404);
        }
    }

    public function deleteById(Request $request, $id) {
        $userId = $request->user()["id"];
        $deleted = $this->assets->deleteUserAssetById($userId, $id);
        if ($deleted) {
            return new Response("", 204);
        } else {
            return new Response("", 404);
        }
    }

    public function updateById(Request $request, $id) {
        $userId = $request->user()["id"];
        $updated = $this->assets->updateAsset($request, $id, $userId);

        if ($updated) {
            return new Response($updated);
        } else {
            return new Response("", 404);
        }
    }

    public function create(Request $request) {
        $userId = $request->user()["id"];
        $asset = $this->assets->createNewAsset($request, $userId);
        if ($asset) {
            return new Response($asset, 201);
        } else {
            return new Response("", 400);
        }
    }
}
