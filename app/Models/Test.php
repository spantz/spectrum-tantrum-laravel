<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Test extends Model
{

    protected $fillable = ['device_id', 'upload_speed', 'download_speed'];

}