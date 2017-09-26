<?php

namespace App\Http\Controllers;

use App\Http\RouteConstants;
use App\Http\ViewConstants;
use App\Models\Repository\DeviceRepository;
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
}
