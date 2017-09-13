<?php
/**
 * Created by PhpStorm.
 * User: trent
 * Date: 7/19/17
 * Time: 10:10 PM
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Factory\DeviceFactory;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegisterDeviceController extends Controller
{
    public function registerDevice(DeviceFactory $factory, Request $request, $userToken)
    {
        $repository = $factory->getRepository();

        $repository->setModel(User::class);
        $user = $repository->query()
            ->where('token', '=', $userToken)
            ->first();

        if (is_null($user)) {
            return response()->json([
                'message' => 'No user found for token.'
            ], 400);
        }

        $repository->setModel($repository->getDefaultModel());
        $desiredName = $request->get('name', $request->ip());
        $name = $repository->generateUniqueDeviceName($user, $desiredName);

        $created_at = Carbon::now();

        /** @var Device $device */
        $device = $factory->make([
            'name' => $name,
            'auth_token' => '',
            'created_at' => $created_at,
        ], [
            'user' => $user
        ]);

        $device->auth_token = $factory->getRepository()->generateUniqueToken($device->id, $device->created_at);
        $device->save();

        return response()->json([
            'message' => 'success',
            'token' => $device->auth_token
        ]);
    }
}