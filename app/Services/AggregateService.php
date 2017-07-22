<?php


namespace App\Services;


use App\Models\Repository\TestRepository;
use App\Models\Test;
use App\Models\User;

class AggregateService
{
    private $repository;

    function __construct(TestRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getDashboardAggregates(User $user, $duration = 7, $unit = Test::DURATION_DAYS)
    {
        $globalAggregates = $this->repository->getGlobalUserAggregates($duration, $unit);
        $userAggregates = $this->repository->getIndividualUserAggregates($user, $duration, $unit);

        return collect([
            'global' => $globalAggregates,
            'user' => $userAggregates
        ]);
    }

}