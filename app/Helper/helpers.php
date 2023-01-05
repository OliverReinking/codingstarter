<?php

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

//
if (!function_exists('transformToQuarterYear')) {
    function transformToQuarterYear(Carbon $date)
    {
        //
        return 'Q' . $date->quarter . ' ' . $date->year;
    }
}
//
if (!function_exists('transformToDecimal')) {
    function transformToDecimal(float $number = null, int $decimals = 2)
    {
        // Rückgabeformat NNNNN.NN, falls $decimals 2 ist
        // kein 1000er-Trennzeichen verwenden!
        $value = 0;
        //
        $dec_point = '.';
        $thousands_sep = '';
        //
        try {
            $value = number_format($number, $decimals, $dec_point, $thousands_sep);
        } catch (Exception $e) {
            Log::error('transformToDecimal', [
                'number' => $number,
                'message' => $e->getMessage(),
            ]);
            $value = 0;
        }
        //
        return $value;
    }
}
//
if (!function_exists('determineValueFromArrayKey')) {
    function determineValueFromArrayKey(array $array = null, string $key)
    {
        $value = null;
        //
        if (Arr::exists($array, $key)) {
            $value = $array[$key];
        }
        //
        return $value;
    }
}
//
if (!function_exists('formatNumber')) {
    function formatNumber(float $number = null, $decimals = 0)
    {
        $dec_point = ',';
        $thousands_sep = '.';

        if (App::isLocale('en')) {
            $dec_point = '.';
            $thousands_sep = ',';
        }

        if ($number == '' || $number == null)
            return 0;

        return number_format($number, $decimals, $dec_point, $thousands_sep);
    }
}

//
if (!function_exists('formatDateTimeLocale')) {
    function formatDateTimeLocale($date = '')
    {
        $format = 'd.m.Y H:i';

        if (App::isLocale('en')) {
            $format = 'd/m/Y H:i';
        }

        if ($date == '' || $date == null)
            return;

        return date($format, strtotime($date));
    }
}

//
if (!function_exists('formatDateLocale')) {
    function formatDateLocale($date = '')
    {
        $format = 'd.m.Y';

        if (App::isLocale('en')) {
            $format = 'd/m/Y';
        }

        if ($date == '' || $date == null)
            return;

        return date($format, strtotime($date));
    }
}

//
if (!function_exists('changeBooleanToNumber')) {
    function changeBooleanToNumber($value = null)
    {
        $number = 0;
        if ($value === true || $value === "true" || $value === 1 || $value === "1") {
            $number = 1;
        }
        //dd("30: ", $value, $number);
        return $number;
    }
}
