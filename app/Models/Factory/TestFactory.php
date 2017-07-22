<?php
/**
 * Created by PhpStorm.
 * User: trent
 * Date: 7/17/17
 * Time: 9:32 PM
 */

namespace App\Models\Factory;


use App\Models\Repository\TestRepository;
use Laracore\Factory\ModelFactory;

class TestFactory extends ModelFactory
{
    public function instantiateRepository()
    {
        return new TestRepository();
    }

    public function getRepository(): TestRepository
    {
        return parent::getRepository();
    }
}