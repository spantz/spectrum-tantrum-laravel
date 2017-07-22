<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property integer id
 */
class User extends Authenticatable
{
    use Notifiable;

    private $activeDevice;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getActiveDevice(): Device
    {
        return $this->activeDevice;
    }

    public function setActiveDevice(Device $device): void
    {
        $this->activeDevice = $device;
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
