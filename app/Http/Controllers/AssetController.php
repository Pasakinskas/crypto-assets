<?php


namespace App\Http\Controllers;


use App\Services\AssetRepository;
use Exception;
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
        try {
            $userId = $request->user()["id"];
            $asset = $this->assets->getUserAssetById($userId, $id);
            return new Response($asset, 200);
        } catch (Exception $e) {
            return new Response(["error" => $e->getMessage()], 404);
        }
    }

    public function deleteById(Request $request, $id) {
        try {
            $userId = $request->user()["id"];
            $this->assets->deleteUserAssetById($userId, $id);
            return new Response("", 204);
        } catch (Exception $e) {
            return new Response(["error" => $e->getMessage()], 404);
        }
    }

    public function updateById(Request $request, $id) {
        try {
            $userId = $request->user()["id"];
            $updated = $this->assets->updateAsset($request, $id, $userId);

            return new Response($updated);
        } catch (Exception $e) {
            return new Response($e, 404);
        }
    }

    public function create(Request $request) {
        try {
            $userId = $request->user()["id"];
            $asset = $this->assets->createNewAsset($request, $userId);

            return new Response($asset, 201);
        } catch(Exception $e) {
            return new Response(["error" => $e->getMessage()], 400);
        }
    }
}
