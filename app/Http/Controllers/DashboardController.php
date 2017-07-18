<?php


namespace App\Http\Controllers;


use App\Http\ViewConstants;
use App\Models\Repository\TestRepository;
use App\Models\Test;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, TestRepository $repository)
    {
//        dd($repository->getIndividualUserAggregates($request->user(), 7, Test::DURATION_DAYS));
        //TODO retrieve high, average, and low aggregate (for last 7 days)
        return view(ViewConstants::DASHBOARD);
    }
}