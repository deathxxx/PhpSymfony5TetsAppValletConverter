<?php


namespace App\Classes;


class Calculator
{

    public function calcMainValuteDesc($val, $amount)
    {
        return $amount / $val;
    }

    public function calcMainValuteAsc($val, $amount)
    {
        return $amount * $val;
    }

    public function calculateDifferentValute($val1, $val2, $amount)
    {
        return $amount * $val1 / $val2;
    }

    public function amountToFloat($amount)
    {
        $dec = '';
        if (strpos($amount, ',') !== false) {
            list($int, $dec) = explode(',', $amount);
        } else if (strpos($amount, '.') !== false) {
            list($int, $dec) = explode('.', $amount);
        } else {
            $int = $amount;
        }

        return floatval($int . '.' . $dec);

    }

}
