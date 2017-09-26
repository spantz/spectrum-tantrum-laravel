<?php


namespace App\Services;


use App\Models\Data\DividedAggregate;
use App\Models\Data\TimestampAggregateResult;
use App\Models\Repository\TestRepository;
use App\Models\User;
use Illuminate\Support\Collection;

/**
 * A service responsible for retrieving divided aggregates.
 * These are things like average download speed every six hours.
 * @see OverviewAggregateService for breakdown across the entirety of a time period.
 *
 * Class DividedAggregateService
 * @package App\Services
 */
class DividedAggregateService
{
    /**
     * @var TestRepository
     */
    private $repository;

    public function __construct(TestRepository $repository)
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
     * Retrieves global and user timestamp aggregates.
     *
     * @param User $user
     * @param int $durationInDays
     * @param float $roundDurationInDays
     * @return Collection
     */
    public function getDividedUserAndGlobalAggregates(User $user, $durationInDays = 7, $roundDurationInDays = .25)
    {
        return collect([
            'global' => $this->getDividedAggregate(null, $durationInDays, $roundDurationInDays),
            'user' => $this->getDividedAggregate($user, $durationInDays, $roundDurationInDays)
        ]);
    }

    /**
     * Retrieves a single divided aggregate.
     *
     * @param User|null $user - the user. If null, retrieves a global aggregate.
     * @param $durationInDays - the duration in days for the data retrieval.
     * @param float $roundDurationInDays - the rounded duration in days. How often we should round the results (i.e. averages for every 6 hours)
     * @return TimestampAggregateResult - the result. Will be empty if no data is returned.
     */
    public function getDividedAggregate(User $user = null, $durationInDays, $roundDurationInDays = .25): TimestampAggregateResult
    {
        $raw = $this->getRepository()->getAggregatesByTimestamp(
            $user,
            $durationInDays,
            $roundDurationInDays
        );

        $dates = collect();
        $down = collect();
        $up = collect();
        $ping = collect();
        $downSD = collect();
        $upSD = collect();
        $pingSD = collect();
        $raw->each(function ($result) use ($dates, $down, $up, $ping, $downSD, $upSD, $pingSD) {
            $aggregate = new DividedAggregate($result);
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
}