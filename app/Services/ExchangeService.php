<?php


namespace App\Services;


use Requests;

class ExchangeService {

    private static $BTC_URI = "https://api.coindesk.com/v1/bpi/currentprice/";
    private static $ETH_URI ="https://api.livecoin.net/exchange/ticker?currencyPair=ETH/";
    private static $MIOTA_URI = "https://min-api.cryptocompare.com/data/price?fsym=MIOTA&tsyms=";

    static function getBtcPrice($currency) {
        $uri = self::$BTC_URI . $currency;
        $response = Requests::get($uri)->body;
        return json_decode($response, true)["bpi"][strtoupper($currency)]["rate_float"];
    }

    static function getEthPrice($currency) {
        $uri = self::$ETH_URI . strtoupper($currency);
        $response = Requests::get($uri)->body;
        return json_decode($response, true)["last"];
    }

    static function getMiotaPrice($currency) {
        $uri = self::$MIOTA_URI . strtoupper($currency) . "&api_key=" . getenv("CRYPTOCOMPARE_API_KEY");
        $response = Requests::get($uri)->body;
        return json_decode($response, true)["EUR"];
    }
}
