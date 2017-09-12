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

    /**
     * Converts bits to bytes.
     * Can be used to convert from Kb -> KB, or Mb -> MB.
     *
     * @param float $amount
     * @return float
     */
    public static function convertBitsToBytes(float $amount): float
    {
        return self::round($amount * self::BITS_TO_BYTES_FACTOR);
    }

    /**
     * Converts bytes to bits.
     * Can be used to convert from KB -> Kb, or MB -> Mb.
     *
     * @param float $amount
     * @return float
     */
    public static function convertBytesToBits(float $amount): float
    {
        return self::round($amount * self::BYTES_TO_BITS_FACTOR);
    }

    /**
     * Converts kilo to mega.
     * Can be used to convert from Kb -> Mb, or KB -> MB.
     *
     * @param float $amount
     * @return float
     */
    public static function convertKiloToMega(float $amount): float
    {
        return self::round($amount * self::KILO_TO_MEGA_FACTOR);
    }

    /**
     * Converts mega to kilo.
     * Can be used to convert from Mb -> Kb, or MB -> Mb.
     *
     * @param float $amount
     * @return float
     */
    public static function convertMegaToKilo(float $amount): float
    {
        return self::round($amount * self::MEGA_TO_KILO_FACTOR);
    }

    /**
     * Converts kilobits to megabytes.
     *
     * @param float $amount
     * @return float
     */
    public static function convertKilobitsToMegabytes(float $amount): float
    {
        return self::round($amount * (self::KILO_TO_MEGA_FACTOR * self::BITS_TO_BYTES_FACTOR));
    }

    /**
     * Converts megabytes to kilobits.
     *
     * @param float $amount
     * @return float
     */
    public static function convertMegabytesToKilobits(float $amount): float
    {
        return self::round($amount * (self::MEGA_TO_KILO_FACTOR * self::BYTES_TO_BITS_FACTOR));
    }

    /**
     * Converts megabits to kilobytes.
     *
     * @param float $amount
     * @return float
     */
    public static function convertMegabitsToKilobytes(float $amount)
    {
        return self::round($amount * (self::MEGA_TO_KILO_FACTOR * self::BITS_TO_BYTES_FACTOR));
    }

    /**
     * Converts kilobytes to megabits.
     *
     * @param float $amount
     * @return float
     */
    public static function convertKilobytesToMegabits(float $amount)
    {
        return self::round($amount * (self::KILO_TO_MEGA_FACTOR * self::BYTES_TO_BITS_FACTOR));
    }

    /**
     * Rounds off our number using the {@link round} method
     * @see round()
     *
     * @param float $amount
     * @param int $precision
     * @return float
     */
    public static function round(float $amount, int $precision = 2): float
    {
        return round($amount, $precision);
    }

}