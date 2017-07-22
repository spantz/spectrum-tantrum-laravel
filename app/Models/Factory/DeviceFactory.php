<?php
/**
 * Created by PhpStorm.
 * User: trent
 * Date: 7/22/17
 * Time: 11:19 AM
 */

namespace App\Models\Factory;


use App\Models\Repository\DeviceRepository;
use Laracore\Factory\ModelFactory;

class DeviceFactory extends ModelFactory
{
    public function instantiateRepository()
    {
        return new DeviceRepository();
    }

    public function getRepository() : DeviceRepository
    {
        return parent::getRepository();
    }
}