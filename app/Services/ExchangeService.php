<?php


namespace App\Services;


use Error;
use Requests;

class ExchangeService {

    private static $BTC_URI = "https://api.coindesk.com/v1/bpi/currentprice/";
    private static $ETH_URI = "https://api.coingecko.com/api/v3/simple/price?ids=ethereum&vs_currencies=";
    private static $IOTA_URI = "https://min-api.cryptocompare.com/data/price?fsym=MIOTA&tsyms=";

    private function getBtcPrice($currency) {
        $uri = self::$BTC_URI . $currency;
        $response = Requests::get($uri)->body;
        return json_decode($response, true)["bpi"][strtoupper($currency)]["rate_float"];
    }

    private function getEthPrice($currency) {
        $uri = self::$ETH_URI . $currency;
        $response = Requests::get($uri)->body;

        return json_decode($response, true)["ethereum"][strtolower($currency)];
    }

    private function getIotaPrice($currency) {
        $uri = self::$IOTA_URI . strtoupper($currency) . "&api_key=" . getenv("CRYPTOCOMPARE_API_KEY");
        $response = Requests::get($uri)->body;
        return json_decode($response, true)[strtoupper($currency)];
    }

    function getCryptoValues($currency) {
        return [
            "BTC" => $this->getBtcPrice($currency),
            "ETH" => $this->getEthPrice($currency),
            "IOTA" => $this->getIotaPrice($currency),
        ];
    }

    function calculateTotalValue($assetList, $currency) {
        $cryptoValues = $this->getCryptoValues($currency);
        $sum = 0;

        foreach ($assetList as $asset) {
            $cryptoType = $asset["currency"];
            $cryptoAmount = $asset["value"];
            $assetValueInFiat = bcmul($cryptoValues[$cryptoType], $cryptoAmount, 6);

            $sum = bcadd($assetValueInFiat, $sum, 2);
        }
        return $sum;

//        $sum = array_reduce($assetList, function($acc, $asset) use ($cryptoValues) {
//            $cryptoType = $asset["currency"];
//            $cryptoAmount = $asset["value"];
//            $assetValue = bcmul($cryptoValues[$cryptoType], $cryptoAmount, 6);
//            return bcadd($acc, $assetValue, 6);
//        }, "0");
//
//        return bcadd($sum, '0', 2);
    }


    function calculateAssetValue($asset, $currency) {
        $cryptoCurrency = $asset["currency"];

        switch ($cryptoCurrency) {
            case "BTC":
                return bcmul($asset["value"], self::getBtcPrice($currency), 2);
            case "ETH":
                return bcmul($asset["value"], self::getEthPrice($currency), 2);
            case "IOTA":
                return bcmul($asset["value"], self::getIotaPrice($currency), 2);
        }
        throw new Error("Crypto currency not found");
    }
}
