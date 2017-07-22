<?php
/**
 * Created by PhpStorm.
 * User: trent
 * Date: 7/19/17
 * Time: 10:10 PM
 */

namespace App\Http\Controllers;

use App\Models\Factory\DeviceFactory;
use App\Models\User;
use Illuminate\Http\Request;
use Laracore\Repository\ModelRepository;
use Auth;
use App\Models\Device;


class RegisterDeviceController
{
    public function registerDevice(DeviceFactory $factory, Request $request, $userToken)
    {
        $remoteIP = $request->ip();

        $deviceAlreadyRegistered = \DB::table('devices')
            ->where('ip', '=', $remoteIP)
            ->exists();

        if ($deviceAlreadyRegistered) {
            return response('This ip has already been used to register a device.', 400);
        }

        $user = User::where('token', '=', $userToken)->first();

        if (is_null($user)) {
            return response('No user found for token.', 400);
        }

        $factory->setRepository(new ModelRepository(Device::Class));

        $device = $factory->make([
            'user_id' => $user->id,
            'ip' => $remoteIP,
            'auth_token' => $factory->getRepository()
                ->generateUniqueToken()
        ]);

        return response()->json($device->auth_token);
    }
}