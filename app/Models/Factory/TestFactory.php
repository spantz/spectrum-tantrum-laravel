<?php
/**
 * Created by PhpStorm.
 * User: trent
 * Date: 7/17/17
 * Time: 9:32 PM
 */

namespace App\Models\Factory;


class TestFactory extends ModelFactory
{
    public function instantiateRepository()
    {
        return new TestRepository();
    }
}