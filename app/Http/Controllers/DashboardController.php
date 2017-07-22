<?php


namespace App\Http\Controllers;


use App\Http\ViewConstants;
use App\Services\AggregateService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, AggregateService $service)
    {
        return view(ViewConstants::DASHBOARD, ['aggregates' => $service->getDashboardAggregates($request->user())]);
    }
}