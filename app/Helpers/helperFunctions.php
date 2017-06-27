<?php
use Helpers\BasicFunctions;

function formatCurrency($number, $sign = false, $min = 0)
{
    $currency = BasicFunctions::getCurrentCurrency();
    $converted = number_format((double) $number, 2, '.', ',');
    if ($converted < $min) {
        $converted = number_format((double) $min, 2, '.', ',');
    }
    if ($sign) {
        $converted = sprintf("%s %s", $currency, $converted);
    }
    return $converted;
}