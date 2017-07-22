<?php


namespace App\Models\Data;


class AggregateConstants
{
    const DURATION_HOURS = 'hours';
    const DURATION_DAYS = 'days';
    const DURATION_WEEKS = 'months';
    const DURATION_YEARS = 'years';

    const DURATIONS = [
        self::DURATION_HOURS,
        self::DURATION_DAYS,
        self::DURATION_WEEKS,
        self::DURATION_YEARS,
    ];

    public static function getDurations()
    {
        return self::DURATIONS;
    }
}