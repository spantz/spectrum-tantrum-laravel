<?php
/**
 * Created by PhpStorm.
 * User: trent
 * Date: 7/22/17
 * Time: 12:50 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PingController
{
    public function verifyToken(Request $request)
    {
        if (!$request->has('auth_token')) {
            return response()->json('No token detected.', 400);
        }

        $deviceExists = \DB::table('devices')
            ->where('auth_token', '=', $request->auth_token)
            ->exists();

        if ($deviceExists) {
           return response()->json('Device is successfully authenticated', 200);
        }
        else {
            return response()->json('Device not authenticated', 200);
        }
    }
}