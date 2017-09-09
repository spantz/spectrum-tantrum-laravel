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

    /**
     * Retrieves individual user aggregates.
     *
     * @param User $user
     * @param int $duration
     * @param string $unit
     * @return UserAggregate|null
     */
    public function getIndividualUserAggregates(User $user, $duration = 7, $unit = AggregateConstants::DURATION_DAYS): ?UserAggregate
    {
        $durationInDays = $this->convertDurationToDays($duration, $unit);
        $raw = $this->getRepository()->getAggregatesForUsers(collect([$user]), $durationInDays);
        return $this->createUserAggregate($raw->first());
    }

    /**
     * Retrieves global aggregates.
     *
     * @param int $duration
     * @param string $unit
     * @return UserAggregate|null
     */
    public function getGlobalUserAggregates($duration = 7, $unit = AggregateConstants::DURATION_DAYS): ?UserAggregate
    {
        $durationInDays = $this->convertDurationToDays($duration, $unit);
        $raw = $this->getRepository()->getAggregatesForUsers(null, $durationInDays);

        return $this->createUserAggregate($raw->first());
    }

    /**
     * Retrieves dashboard aggregates for both global and user.
     *
     * @param User $user
     * @param int $duration
     * @param string $unit
     * @return Collection
     */
    public function getDashboardAggregates(User $user, $duration = 7, $unit = AggregateConstants::DURATION_DAYS)
    {
        $globalAggregates = $this->getGlobalUserAggregates($duration, $unit);
        $userAggregates = $this->getIndividualUserAggregates($user, $duration, $unit);

        return collect([
            'global' => $globalAggregates,
            'user' => $userAggregates
        ]);
    }

    /**
     * Retrieves global and user timestamp aggregates.
     *
     * @param User $user
     * @param int $duration
     * @param string $unit
     * @param int $roundDuration
     * @return Collection
     */
    public function getTimestampedUserAndGlobalAggregates(User $user, $duration = 7, $unit = AggregateConstants::DURATION_DAYS, $roundDuration = 21600)
    {
        return collect([
            'global' => $this->getTimestampedAggregates(null, $duration, $unit, $roundDuration),
            'user' => $this->getTimestampedAggregates($user, $duration, $unit, $roundDuration)
        ]);
    }

    /**
     * Retrieves our timestamped aggregates for the user, based on durations and rounding duration.
     *
     * @param User|null $user - the user to retrieve aggregates for. If null, will do a global stats call.
     * @param int $duration - the duration. Uses unit to determine the conversion.
     * @param string $unit - the unit of the duration (i.e. days)
     * @param int $roundDuration - the duration to round to, in seconds. i.e. setting this as 21600 will round results to every 6 hours.
     * @return TimestampAggregateResult
     */
    public function getTimestampedAggregates(User $user = null, $duration = 7, $unit = AggregateConstants::DURATION_DAYS, $roundDuration = 21600): TimestampAggregateResult
    {
        $raw = $this->getRepository()->getAggregatesByTimestamp(
            $user,
            $this->convertDurationToDays($duration, $unit),
            $roundDuration
        );

        $dates = collect();
        $down = collect();
        $up = collect();
        $ping = collect();
        $downSD = collect();
        $upSD = collect();
        $pingSD = collect();
        $raw->each(function ($result) use ($dates, $down, $up, $ping, $downSD, $upSD, $pingSD) {
            $aggregate = $this->createTimestampAggregate($result);
            $dates->push($aggregate->getDate());
            $down->push($aggregate->getDownload());
            $up->push($aggregate->getUpload());
            $ping->push($aggregate->getPing());
            $downSD->push($aggregate->getDownSD());
            $upSD->push($aggregate->getUpSD());
            $pingSD->push($aggregate->getPingSD());
        });

        return new TimestampAggregateResult($dates, $down, $up, $ping, $downSD, $upSD, $pingSD);
    }

    /**
     * Creates a UserAggregate instance.
     * If the object passed in is null, returns null.
     *
     * @param \stdClass|null $result
     * @return UserAggregate|null
     */
    protected function createUserAggregate(\stdClass $result = null): ?UserAggregate
    {
        return !empty($result) ? new UserAggregate($result) : null;
    }

    /**
     * Creates a TimestampAggregate instance.
     * If the object passed in is null, returns null.
     *
     * @param \stdClass $result
     * @return TimestampAggregate|null
     */
    protected function createTimestampAggregate(\stdClass $result = null): ?TimestampAggregate
    {
        return !empty($result) ? new TimestampAggregate($result) : null;
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