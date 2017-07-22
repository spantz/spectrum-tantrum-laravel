<?php


namespace App\Models\Repository;


use App\Models\Test;
use App\Models\User;
use Laracore\Repository\ModelRepository;

class TestRepository extends ModelRepository
{
    public function getDefaultModel()
    {
        return Test::class;
    }

    public function getIndividualUserAggregates(User $user, $duration, $unit)
    {
        $durationInDays = $this->convertDurationToDays($duration, $unit);

        $results = \DB::table('tests')
            ->select([
                \DB::raw('max(`download_speed`) as `max`'),
                \DB::raw('min(`download_speed`) as `min`'),
                \DB::raw('avg(`download_speed`) as `average`'),
            ])
            ->from('tests')
            ->join('devices', 'tests.device_id', '=', 'devices.id')
            ->join('users', 'devices.user_id', '=', 'users.id')
            ->where('users.id', '=', $user->id)
            ->where('tests.created_at', '>', \DB::raw('DATE_SUB(DATE_FORMAT(NOW(),"%Y-%m-%d 23:59:59"), INTERVAL ' . $durationInDays . ' DAY)'))
            ->groupBy('devices.id')
            ->get();

        //TODO remove use of DB::raw
        return $results;
    }

    protected function convertDurationToDays($duration, $unit): float
    {
        switch ($unit) {
            case Test::DURATION_YEARS:
                $conversionRate = 365;
                break;
            case Test::DURATION_WEEKS:
                $conversionRate = 7;
                break;
            case Test::DURATION_HOURS:
                $conversionRate = (1/24);
                break;
            default:
                $conversionRate = 1;
                break;
        }

        return $duration * $conversionRate;
    }

}