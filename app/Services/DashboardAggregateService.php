<?php


namespace App\Services;


use App\Models\Data\AggregateConstants;
use App\Models\Data\TimestampAggregate;
use App\Models\Data\TimestampAggregateResult;
use App\Models\Data\OverviewAggregate;
use App\Models\Repository\TestRepository;
use App\Models\User;
use Illuminate\Support\Collection;

class DashboardAggregateService
{
    /**
     * @var OverviewAggregateService
     */
    private $overviewService;
    /**
     * @var DividedAggregateService
     */
    private $dividedService;

    public function __construct(OverviewAggregateService $overviewService, DividedAggregateService $dividedService)
    {
        $this->overviewService = $overviewService;
        $this->dividedService = $dividedService;
    }

    /**
     * @return OverviewAggregateService
     */
    public function getOverviewService(): OverviewAggregateService
    {
        return $this->overviewService;
    }

    /**
     * @return DividedAggregateService
     */
    public function getDividedService(): DividedAggregateService
    {
        return $this->dividedService;
    }

    public function getDashboardAggregates(
        User $user,
        $duration = 7,
        $durationUnit = AggregateConstants::DURATION_DAYS,
        $roundDuration = 6,
        $roundDurationUnit = AggregateConstants::DURATION_HOURS
    ): Collection {
        $durationInDays = $this->convertDurationToDays($duration, $durationUnit);
        $roundDurationInDays = $this->convertDurationToDays($roundDuration, $roundDurationUnit);

        $overview = $this->getOverviewService()
            ->getUserAndGlobalAggregates($user, $durationInDays);

        $divided = $this->getDividedService()
            ->getDividedUserAndGlobalAggregates($user, $durationInDays, $roundDurationInDays);

        return collect([
            'overview' => $overview,
            'divided' => $divided
        ]);
    }

    /**
     * Converts unit durations to the same amount in days.
     * Allows us to apply the desired amount to our queries.
     * @see AggregateConstants for an example duration.
     *
     * @param $duration - the duration. A number (i.e. 7)
     * @param $unit - the unit. Should reference a valid unit
     * @return float - the duration converted to days.
     */
    public function convertDurationToDays($duration, $unit): float
    {
        switch ($unit) {
            case AggregateConstants::DURATION_YEARS:
                $conversionRate = 365;
                break;
            case AggregateConstants::DURATION_WEEKS:
                $conversionRate = 7;
                break;
            case AggregateConstants::DURATION_HOURS:
                $conversionRate = (1/24);
                break;
            default:
                $conversionRate = 1;
                break;
        }

        return $duration * $conversionRate;
    }

}