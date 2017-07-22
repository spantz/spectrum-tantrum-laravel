<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Test extends Model
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

    protected $fillable = ['device_id', 'upload_speed', 'download_speed'];

}