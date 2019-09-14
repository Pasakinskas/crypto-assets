<?php


namespace App\Http\Validation\Components;


use MyCLabs\Enum\Enum;

class CryptoCurrencyEnum extends Enum {
    private const BTC = "BTC";
    private const ETH = "ETH";
    private const MIOTA = "IOTA";
}
