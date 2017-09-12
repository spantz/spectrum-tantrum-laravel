<?php


namespace App\Util;


/**
 * A conversion util class.
 * Used to convert between different
 * amounts of bits or bytes.
 *
 * Class ConversionUtil
 * @package App\Util
 */
class ConversionUtil
{
    const KILO_TO_MEGA_FACTOR = .001;
    const MEGA_TO_KILO_FACTOR = 1000;
    const BITS_TO_BYTES_FACTOR = .125;
    const BYTES_TO_BITS_FACTOR = 8;

    public static function convertBitsToBytes($amount): float
    {
        return self::round($amount * self::BITS_TO_BYTES_FACTOR);
    }

    public static function convertBytesToBits($amount): float
    {
        return self::round($amount * self::BYTES_TO_BITS_FACTOR);
    }

    public static function convertKiloToMega($amount): float
    {
        return self::round($amount * self::KILO_TO_MEGA_FACTOR);
    }

    public static function convertMegaToKilo($amount): float
    {
        return self::round($amount * self::MEGA_TO_KILO_FACTOR);
    }

    public static function convertKilobitsToMegabytes($amount): float
    {
        return self::round($amount * (self::KILO_TO_MEGA_FACTOR * self::BITS_TO_BYTES_FACTOR));
    }

    public static function convertMegabytesToKilobits($amount): float
    {
        return self::round($amount * (self::MEGA_TO_KILO_FACTOR * self::BYTES_TO_BITS_FACTOR));
    }

    public static function convertMegabitsToKilobytes($amount)
    {
        return self::round($amount * (self::MEGA_TO_KILO_FACTOR * self::BITS_TO_BYTES_FACTOR));
    }

    public static function convertKilobytesToMegabits($amount)
    {
        return self::round($amount * (self::KILO_TO_MEGA_FACTOR * self::BYTES_TO_BITS_FACTOR));
    }

    public static function round($amount, $precision = 2): float
    {
        return round($amount, $precision);
    }

}