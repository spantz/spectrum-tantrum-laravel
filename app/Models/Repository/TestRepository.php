<?php


namespace App\Models\Repository;


use App\Models\Data\UserAggregate;
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

    public function getAggregatesForUsers(Collection $users = null, $durationInDays = 7): Collection
    {
        $query = \DB::table('tests')
            ->select([
                \DB::raw('max(`download_speed`) as `' . UserAggregate::COLUMN_MAX . '`'),
                \DB::raw('min(`download_speed`) as `' . UserAggregate::COLUMN_MIN . '`'),
                \DB::raw('avg(`download_speed`) as `' . UserAggregate::COLUMN_AVERAGE . '`'),
            ])
            ->from('tests')
            ->join('devices', 'tests.device_id', '=', 'devices.id')
            ->join('users', 'devices.user_id', '=', 'users.id');

        if ($users != null) {
            $query->whereIn('users.id', $users->pluck('id'));
        }

        return $query
            ->where('tests.created_at', '>', \DB::raw('DATE_SUB(DATE_FORMAT(NOW(),"%Y-%m-%d 23:59:59"), INTERVAL ' . $durationInDays . ' DAY)'))
            ->groupBy('devices.user_id')
            ->get();
    }

    public function getAggregatesByTimestamp(User $user, $durationInDays = 7, $roundDuration = 300)
    {
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

}