<?php


namespace App\Models\Repository;


use App\Models\Device;
use App\Models\User;
use Laracore\Repository\ModelRepository;

class DeviceRepository extends ModelRepository
{
    public function getDefaultModel()
    {
        return Device::class;
    }

    public function userHasDevices(User $user): bool {
        return $this
            ->query()
            ->where('user_id', '=', $user->id)
            ->exists();
    }

}