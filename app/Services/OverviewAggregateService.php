<?php


namespace App\Services;


use App\Models\Data\OverviewAggregate;
use App\Models\Repository\TestRepository;
use App\Models\User;
use Illuminate\Support\Collection;

/**
 * A service responsible for retrieving overview aggregates.
 * These are things like overall highest download speed, overall
 * lowest speed, averages like average ping, etc. across the entirety
 * of a duration.
 * @see DividedAggregateService for breakdown by period of time (i.e. hours).
 *
 * Class OverviewAggregateService
 * @package App\Services
 */
class OverviewAggregateService
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
     * Retrieves user and global overview aggregates for both global and user.
     * Returns a collection with two keys: user, and global.
     * @see OverviewAggregate to see the object type of each key.
     *
     * @param User $user
     * @param int $durationInDays
     * @return Collection
     */
    public function getUserAndGlobalAggregates(User $user, $durationInDays = 7)
    {
        $user = $this->getUserOverviewAggregate($user, $durationInDays);
        $global = $this->getGlobalOverviewAggregate($durationInDays);

        return collect([
            'user' => $user,
            'global' => $global
        ]);
    }

    /**
     * Retrieves an individual user's overview aggregate.
     *
     * @param User $user
     * @param int $durationInDays
     * @return OverviewAggregate
     */
    public function getUserOverviewAggregate(User $user, $durationInDays = 7): OverviewAggregate
    {
        $raw = $this->getRepository()->getAggregatesForUsers(collect([$user]), $durationInDays);

        return new OverviewAggregate($raw->first());
    }

    /**
     * Retrieves global overview aggregate.
     *
     * @param int $durationInDays
     * @return OverviewAggregate
     */
    public function getGlobalOverviewAggregate($durationInDays = 7): OverviewAggregate
    {
        $raw = $this->getRepository()->getAggregatesForUsers(null, $durationInDays);

        return new OverviewAggregate($raw->first());
    }
}