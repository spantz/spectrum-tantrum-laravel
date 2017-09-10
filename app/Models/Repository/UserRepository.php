<?php


namespace App\Models\Repository;


use App\Http\TokenConstants;
use App\Models\User;
use Laracore\Repository\ModelRepository;

class UserRepository extends ModelRepository
{
    /**
     * @inheritdoc
     */
    public function getDefaultModel()
    {
        return User::class;
    }

    /**
     * Generates a unique token and returns it.
     *
     * @return string
     */
    public function generateUniqueToken($userId, $timestamp): string
    {
        return encrypt('USER' . TokenConstants::DELIMITER . $userId . TokenConstants::DELIMITER . $timestamp);
    }
}