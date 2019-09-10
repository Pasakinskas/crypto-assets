<?php


namespace App\Http\Validation\Components;


use MyCLabs\Enum\Enum;

class CurrencyEnum extends Enum {
    private const BTC = "BTC";
    private const ETH = "ETH";
    private const MIOTA = "MIOTA";
}
