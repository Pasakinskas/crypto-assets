<?php


namespace App\Http\Validation\Components;

use MyCLabs\Enum\Enum;

class FiatCurrencyEnum extends Enum {
    private const USD = "USD";
    private const EUR = "EUR";
    private const GBP = "GBP";
    private const INR = "INR";
    private const AUD = "AUD";
    private const CAD = "CAD";
    private const SGD = "SGD";
    private const CHF = "CHF";
    private const JPY = "JPY";
    private const CNY = "CNY";
}
