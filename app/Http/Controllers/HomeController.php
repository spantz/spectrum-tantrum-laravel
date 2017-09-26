<?php

namespace App\Http\Controllers;

use App\Http\RouteConstants;
use App\Http\ViewConstants;
use App\Models\Repository\DeviceRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Device registration route.
     *
     * @method GET
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deviceRegistration(Request $request)
    {
        return view(ViewConstants::DEVICE_REGISTRATION, ['user' => $request->user()]);
    }

    /**
     * Checks for a new user device registration.
     *
     * @method GET
     * @param Request $request
     * @param DeviceRepository $repository
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkForDevice(Request $request, DeviceRepository $repository)
    {
        return response()
            ->json([
                'exists' => $repository->userHasRecentlyRegisteredDevice($request->user())
            ]);
    }
}
