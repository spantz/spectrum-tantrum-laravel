<?php


namespace App\Http\Controllers;


use App\Http\Requests\DashboardRequest;
use App\Http\ViewConstants;
use App\Services\AggregateService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @var AggregateService
     */
    private $service;

    function __construct(AggregateService $service)
    {
        $this->service = $service;
    }

    /**
     * @return AggregateService
     */
    public function getService(): AggregateService
    {
        return $this->service;
    }

    public function index(Request $request)
    {
        return view(ViewConstants::DASHBOARD, ['aggregates' => $this->getService()->getDashboardAggregates($request->user())]);
    }

    public function filteredData(DashboardRequest $request)
    {
        return $this->getService()->getDashboardAggregates(
            $request->user(),
            $request->getDuration(),
            $request->getUnit()
        );
    }
}