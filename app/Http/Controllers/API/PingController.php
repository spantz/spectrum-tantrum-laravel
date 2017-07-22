<?php
/**
 * Created by PhpStorm.
 * User: trent
 * Date: 7/22/17
 * Time: 12:50 PM
 */

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class PingController
{
    public function verifyToken($authToken)
    {
        $deviceExists = \DB::table('devices')
            ->where('auth_token', '=', $authToken)
            ->exists();

        if ($deviceExists) {
           return response()->json('Device is successfully authenticated', 200);
        }
        else {
            return response()->json('Device not authenticated', 200);
        }
    }
}