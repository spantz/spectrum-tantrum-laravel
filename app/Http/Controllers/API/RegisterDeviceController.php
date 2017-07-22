<?php
/**
 * Created by PhpStorm.
 * User: trent
 * Date: 7/19/17
 * Time: 10:10 PM
 */

namespace App\Http\Controllers\API;

use App\Models\Factory\DeviceFactory;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterDeviceController
{
    public function registerDevice(DeviceFactory $factory, Request $request, $userToken)
    {
        $remoteIP = $request->ip();

        $deviceAlreadyRegistered = \DB::table('devices')
            ->where('ip', '=', $remoteIP)
            ->exists();

        if ($deviceAlreadyRegistered) {
            return response()->json(['message' => 'This ip has already been used to register a device.'], 400);
        }

        $user = User::where('token', '=', $userToken)->first();

        if (is_null($user)) {
            return response()->json([
                'message' => 'No user found for token.'
            ], 400);
        }

        $device = $factory->make([
            'user_id' => $user->id,
            'ip' => $remoteIP,
            'auth_token' => $factory->getRepository()
                ->generateUniqueToken()
        ]);

        return response()->json([
            'message' => 'success',
            'token' => $device->auth_token
        ]);
    }
}