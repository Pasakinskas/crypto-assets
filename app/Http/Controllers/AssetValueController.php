<?php


namespace App\Http\Controllers;


use App\Repositories\AssetRepository;
use App\Services\ExchangeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AssetValueController extends AssetController {

    private $exchangeService;

    public function __construct(AssetRepository $assets, ExchangeService $exchangeService) {
        parent::__construct($assets);
        $this->exchangeService = $exchangeService;
    }

    public function getValueById(Request $request, $id) {
        $currency = $this->getCurrencyFromRequest($request);
        $userId = $request->user()["id"];

        $asset = $this->assets->getUserAssetById($userId, $id);
        $assetValue = $this->exchangeService->calculateAssetValue($asset, $currency);
        return new Response($assetValue);
    }

    public function getAllValue(Request $request) {
        $currency = $this->getCurrencyFromRequest($request);
        $userId = $request->user()["id"];

        $userAssets = $this->assets->getAllUserAssets($userId);
        $totalValue = $this->exchangeService->calculateTotalValue($userAssets, $currency);
        return new Response($totalValue);
    }

    private function getCurrencyFromRequest(Request $request) {
        $currency = $request->query("currency");
        return $currency ? $currency : "usd";
    }
}
