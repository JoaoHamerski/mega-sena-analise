<?php

namespace App\Helpers;

class AppHelper
{
    public static function isOdd($number)
    {
        return $number % 2 === 1;
    }

    public static function isEven($number)
    {
        return $number % 2 === 0;
    }
}
