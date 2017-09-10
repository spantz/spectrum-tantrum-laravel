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

    /**
     * Generates a unique device name that isn't the same as any other device in user by this user.
     *
     * @param User $user
     * @param $desiredName - the name "template". Will append numbers to the name to generate a name.
     * @return string
     */
    public function generateUniqueDeviceName(User $user, $desiredName): string
    {
        if (!$this->deviceWithNameExists($user, $desiredName)) {
            return $desiredName;
        }

        $baseName = $desiredName;
        $i = 2;
        do {
            $nextName = $baseName . ' (' . $i . ')';
            $i++;
        }
        while ($this->deviceWithNameExists($user, $nextName));

        return $nextName;
    }

    /**
     * Checks if a device name is already in use for this user.
     *
     * @param User $user
     * @param $desiredName
     * @return bool
     */
    public function deviceWithNameExists(User $user, $desiredName): bool
    {
        return $this->query()
            ->where('user_id', '=', $user->id)
            ->where('name', '=', $desiredName)
            ->exists();
    }
}