<?php


namespace App\Models\Factory;


use App\Models\Repository\UserRepository;
use Laracore\Factory\ModelFactory;

class UserFactory extends ModelFactory
{
    /**
     * @inheritdoc
     */
    public function instantiateRepository(): UserRepository
    {
        return new UserRepository();
    }

    /**
     * @inheritdoc
     * @return UserRepository
     */
    public function getRepository(): UserRepository
    {
        return parent::getRepository();
    }

}