<?php

namespace App\Http\Controllers;

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
     * @param Request $request
     * @param DeviceRepository $repository
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, DeviceRepository $repository)
    {
        if (!$repository->userHasDevices($request->user())) {
            return redirect('/devices/register');
        }
        return view('home');
    }
}
