<?php

namespace App\Http\Controllers;

use App\Http\RouteUtils;
use App\Models\Repository\DeviceRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            return redirect()->route(RouteUtils::DEVICE_REGISTRATION);
        }

        return view('home');
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
        return view('deviceRegistration', ['user' => $request->user()]);
    }
}
