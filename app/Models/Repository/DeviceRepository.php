<?php


namespace App\Models\Repository;


use App\Util\TokenUtil;
use App\Models\Device;
use App\Models\User;
use Carbon\Carbon;
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
     * @param $deviceId
     * @param $timestamp
     * @return string
     */
    public function generateUniqueToken($deviceId, $timestamp): string
    {
        return TokenUtil::encryptToken(TokenUtil::DEVICE . TokenUtil::DELIMITER . $deviceId . TokenUtil::DELIMITER . $timestamp);
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

    /**
     * Checks if a user has recently registered a device.
     * Returns true or false based on the result.
     *
     * @param User $user - the user being checked for.
     * @param int $minutesBackToCheck - the amount of time back to check for a new device, in minutes. Defaults to 5 minutes.
     * @return bool - true if a device is found, false otherwise
     */
    public function userHasRecentlyRegisteredDevice(User $user, $minutesBackToCheck = 5)
    {
        return $this->query()
        ->where('created_at', '>', Carbon::now()->subMinutes($minutesBackToCheck))
        ->where('user_id','=', $user->id)
        ->exists();
    }
}