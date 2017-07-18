<?php

namespace App\Http\Controllers;

use App\Http\RouteConstants;
use App\Http\ViewConstants;
use App\Models\Repository\DeviceRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @method GET
     * @param Request $request
     * @param DeviceRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DeviceRepository $repository)
    {
        if (!$repository->userHasDevices($request->user())) {
            return redirect()->route(RouteConstants::DEVICE_REGISTRATION);
        }

        return view(ViewConstants::HOME);
    }

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
}
