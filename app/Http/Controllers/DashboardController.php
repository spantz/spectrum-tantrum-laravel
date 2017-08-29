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
        return view(ViewConstants::DASHBOARD, collect([
            'aggregates' => $this->getService()->getDashboardAggregates($request->user()),
            'data' => $this->getService()->getTimestampedUserAndGlobalAggregates($request->user())
        ]));
    }

    public function averages(DashboardRequest $request)
    {
        return $this->getService()->getDashboardAggregates(
            $request->user(),
            $request->getDuration(),
            $request->getUnit()
        );
    }

    public function timestampedAggregates(DashboardRequest $request, $timeFrame = 'sixHours')
    {
        switch ($timeFrame) {
            case 'fiveMinutes':
                $duration = 300;
                break;
            case 'fifteenMinutes':
                $duration = (300 * 3);
                break;
            case 'hours':
                $duration = 3600;
                break;
            case 'sixHours':
                $duration = (3600 * 6);
                break;
            default:
                // Days
                $duration = (3600 * 24);
                break;
        }

        return $this->getService()->getTimestampedUserAndGlobalAggregates(
            $request->user(),
            $request->getDuration(),
            $request->getUnit(),
            $duration
        );
    }
}