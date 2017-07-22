<?php
/**
 * Created by PhpStorm.
 * User: trent
 * Date: 7/22/17
 * Time: 12:50 PM
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class PingController extends Controller
{
    public function verifyToken()
    {
        return response()->json(['message' => 'Success']);
    }
}