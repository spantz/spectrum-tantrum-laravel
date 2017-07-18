<?php
/**
 * Created by PhpStorm.
 * User: trent
 * Date: 7/17/17
 * Time: 7:30 PM
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Test;


class TestController extends Controller
{
    /**
     * @param Request $request
     */
    public function logSpeed(Request $request)
    {
        //TODO: validate API credentials

        $this->validate($request, [
            'download_speed' => 'required',
            'upload_speed' => 'required',
            'timestamp' => 'required',
        ]);

        //TODO: rewrite using LaraCore

        $test = Test::create([
            'device_id' => $request->device_id,
            'download_speed' => $request->download_speed,
            'upload_speed' => $request->upload_speed,
        ]);


        return response()->json('success');
    }
}