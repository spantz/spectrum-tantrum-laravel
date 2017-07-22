<?php


namespace App\Services;


use App\Models\Data\AggregateConstants;
use App\Models\Data\TimestampAggregate;
use App\Models\Data\TimestampAggregateResult;
use App\Models\Data\UserAggregate;
use App\Models\Repository\TestRepository;
use App\Models\User;
use Illuminate\Support\Collection;

class AggregateService
{
    /**
     * @var TestRepository
     */
    private $repository;

    function __construct(TestRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return TestRepository
     */
    public function getRepository(): TestRepository
    {
        return $this->repository;
    }

    public function getIndividualUserAggregates(User $user, $duration = 7, $unit = AggregateConstants::DURATION_DAYS): UserAggregate
    {
        $durationInDays = $this->convertDurationToDays($duration, $unit);
        $raw = $this->getRepository()->getAggregatesForUsers(collect([$user]), $durationInDays);
        return $this->createUserAggregate($raw->first());
    }

    public function getGlobalUserAggregates($duration = 7, $unit = AggregateConstants::DURATION_DAYS): UserAggregate
    {
        $durationInDays = $this->convertDurationToDays($duration, $unit);
        $raw = $this->getRepository()->getAggregatesForUsers(null, $durationInDays);
        return $this->createUserAggregate($raw->first());
    }

    public function getDashboardAggregates(User $user, $duration = 7, $unit = AggregateConstants::DURATION_DAYS)
    {
        $globalAggregates = $this->getGlobalUserAggregates($duration, $unit);
        $userAggregates = $this->getIndividualUserAggregates($user, $duration, $unit);

        return collect([
            'global' => $globalAggregates,
            'user' => $userAggregates
        ]);
    }

    public function getTimestampedAggregates(User $user, $duration = 7, $unit = AggregateConstants::DURATION_DAYS, $roundDuration = 300): TimestampAggregateResult
    {
        $raw = $this->getRepository()->getAggregatesByTimestamp(
            $user,
            $this->convertDurationToDays($duration, $unit),
            $roundDuration
        );

        $dates = collect();
        $results = collect();
        $raw->each(function ($result) use ($dates, $results) {
            $aggregate = $this->createTimestampAggregate($result);
            $dates->push($aggregate->getDate());
            $results->push($aggregate);
        });

        return new TimestampAggregateResult($dates, $results);
    }

    protected function createUserAggregate(\stdClass $result): UserAggregate
    {
        return new UserAggregate($result);
    }

    protected function createTimestampAggregate(\stdClass $result): TimestampAggregate
    {
        return new TimestampAggregate($result);
    }

    protected function convertDurationToDays($duration, $unit): float
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