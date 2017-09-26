<?php


namespace App\Http\Controllers;


use App\Http\Requests\DashboardRequest;
use App\Http\RouteConstants;
use App\Http\ViewConstants;
use App\Models\Repository\DeviceRepository;
use App\Services\DashboardAggregateService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @var DashboardAggregateService
     */
    private $service;

    function __construct(DashboardAggregateService $service)
    {
        $this->service = $service;
    }

    /**
     * @return DashboardAggregateService
     */
    public function getService(): DashboardAggregateService
    {
        return $this->service;
    }

    /**
     * @method GET
     * @route /dashboard
     * @param Request $request
     * @param DeviceRepository $repository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, DeviceRepository $repository)
    {
        if (!$repository->userHasDevices($request->user())) {
            return redirect()->route(RouteConstants::DEVICE_REGISTRATION);
        }

        $aggregateData = $this->getService()->getDashboardAggregates($request->user());
        return view(ViewConstants::DASHBOARD, $aggregateData->all());
    }

    /**
     * @method GET
     * @route /dashboard/aggregates
     * @param DashboardRequest $request
     * @return \Illuminate\Support\Collection
     */
    public function aggregates(DashboardRequest $request)
    {
        return $this->getService()
            ->getDashboardAggregates(
                $request->user(),
                $request->getDuration(),
                $request->getDurationUnit(),
                $request->getRoundDuration(),
                $request->getRoundDurationUnit()
            );
    }
}