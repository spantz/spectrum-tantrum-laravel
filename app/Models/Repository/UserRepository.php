<?php


namespace App\Models\Repository;


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
    public function generateUniqueToken(): string
    {
        do {
            $token = str_random(48);
        } while ($this->userWithTokenExists($token));

        return $token;
    }

    /**
     * Tests if the specified token already exists.
     *
     * @param $token
     * @return bool
     */
    public function userWithTokenExists($token): bool {
        return $this->query()
            ->where('api_token', '=', $token)
            ->exists();
    }
}