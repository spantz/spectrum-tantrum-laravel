<?php


namespace App\Models\Repository;


use App\Models\Aggregate;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Collection;
use Laracore\Repository\ModelRepository;

class TestRepository extends ModelRepository
{
    /**
     * {@inheritdoc}
     */
    public function getDefaultModel()
    {
        return Test::class;
    }

    public function getIndividualUserAggregates(User $user, $duration = 7, $unit = Test::DURATION_DAYS): Aggregate
    {
        return $this->getAggregatesForUsers(collect([$user]), $duration, $unit)->first();
    }

    public function getGlobalUserAggregates($duration = 7, $unit = Test::DURATION_DAYS): Aggregate
    {
        return $this->getAggregatesForUsers(null, $duration, $unit)->first();
    }

    public function getAggregatesForUsers(Collection $users = null, $duration = 7, $unit = Test::DURATION_DAYS): Collection
    {
        $durationInDays = $this->convertDurationToDays($duration, $unit);

        $query = \DB::table('tests')
            ->select([
                \DB::raw('max(`download_speed`) as `' . Aggregate::COLUMN_MAX . '`'),
                \DB::raw('min(`download_speed`) as `' . Aggregate::COLUMN_MIN . '`'),
                \DB::raw('avg(`download_speed`) as `' . Aggregate::COLUMN_AVERAGE . '`'),
            ])
            ->from('tests')
            ->join('devices', 'tests.device_id', '=', 'devices.id')
            ->join('users', 'devices.user_id', '=', 'users.id');

        if ($users != null) {
            $query->whereIn('users.id', $users->pluck('id'));
        }

        $results = $query
            ->where('tests.created_at', '>', \DB::raw('DATE_SUB(DATE_FORMAT(NOW(),"%Y-%m-%d 23:59:59"), INTERVAL ' . $durationInDays . ' DAY)'))
            ->groupBy('devices.user_id')
            ->get();

        return $results
            ->map(function ($result) {
                return $this->wrapAggregateResultInModel($result);
            });
    }

    public function getAggregatesByTimestamp(User $user, $duration = 7, $unit = Test::DURATION_DAYS, $roundDuration = 300)
    {
        $durationInDays = $this->convertDurationToDays($duration, $unit);

        //TODO convert to objects
        return \DB::table('tests')
            ->select([
                \DB::raw('AVG(`download_speed`) as `down`'),
                \DB::raw('AVG(`upload_speed`) AS `up`'),
                \DB::raw('FROM_UNIXTIME((UNIX_TIMESTAMP(`tests`.`created_at`) DIV ' . $roundDuration . ') * ' . $roundDuration . ') AS `timestamp`')
            ])
            ->from('tests')
            ->join('devices', 'tests.device_id', '=', 'devices.id')
            ->where('devices.user_id', '=', $user->id)
            ->where('tests.created_at', '>', \DB::raw('DATE_SUB(DATE_FORMAT(NOW(),"%Y-%m-%d 23:59:59"), INTERVAL ' . $durationInDays . ' DAY)'))
            ->groupBy('devices.user_id', 'timestamp')
            ->get();
    }

    protected function wrapAggregateResultInModel(\stdClass $result): Aggregate
    {
        return new Aggregate($result);
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