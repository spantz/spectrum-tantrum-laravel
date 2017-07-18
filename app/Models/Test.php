<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    const DURATION_HOURS = 'hours';
    const DURATION_DAYS = 'days';
    const DURATION_WEEKS = 'months';
    const DURATION_YEARS = 'years';

    protected $fillable = ['device_id', 'upload_speed', 'download_speed'];

}