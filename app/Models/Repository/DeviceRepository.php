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

    /**
     * Generates a unique token and returns it.
     *
     * @return string
     */
    public function generateUniqueToken(): string
    {
        do {
            $token = str_random(48);
        } while ($this->deviceWithTokenExists($token));

        return $token;
    }

    /**
     * Tests if the specified token already exists.
     *
     * @param $token
     * @return bool
     */
    public function deviceWithTokenExists($token): bool
    {
        return $this->query()
            ->where('auth_token', '=', $token)
            ->exists();
    }
}