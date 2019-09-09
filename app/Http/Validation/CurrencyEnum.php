<?php


namespace App\Http\Validation;


use MyCLabs\Enum\Enum;

class CurrencyEnum extends Enum {
    private const BTC = "BTC";
    private const ETH = "ETH";
    private const MIOTA = "MIOTA";
}
