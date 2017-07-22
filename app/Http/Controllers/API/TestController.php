<?php
/**
 * Created by PhpStorm.
 * User: trent
 * Date: 7/17/17
 * Time: 7:30 PM
 */

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Models\Test;
use Laracore\Factory\ModelFactory;
use Laracore\Repository\ModelRepository;


class TestController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logSpeed(ModelFactory $factory, Request $request)
    {
        $this->validate($request, [
            'speed.up' => 'required',
            'speed.down' => 'required',
            'timestamp.start' => 'required',
            'timestamp.end' => 'required',
        ]);

        $factory->setRepository(new ModelRepository(Test::Class));

        $test = $factory->make([
            'device_id' => $request->device_id,
            'download_speed' => $this->convertMegabitsToKilobytes($request->input('speed.down')),
            'upload_speed' => $this->convertMegabitsToKilobytes($request->input('speed.up')),
        ]);

        return response()->json('success');
    }

    private function convertMegabitsToKilobytes($speed)
    {
        return round($speed * 125,2);
    }
}