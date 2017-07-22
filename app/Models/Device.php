<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @property User user
 * @property integer id
 */
class Device extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}