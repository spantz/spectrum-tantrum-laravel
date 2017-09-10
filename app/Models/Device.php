<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @property User user
 * @property integer id
 * @property string auth_token
 */
class Device extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}