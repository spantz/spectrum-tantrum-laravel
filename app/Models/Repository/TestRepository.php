<?php


namespace App\Models\Repository;


use App\Models\Data\TimestampAggregate;
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
                \DB::raw('ROUND(max(`download_speed`), 2) as `' . UserAggregate::COLUMN_MAX . '`'),
                \DB::raw('ROUND(min(`download_speed`), 2) as `' . UserAggregate::COLUMN_MIN . '`'),
                \DB::raw('ROUND(avg(`download_speed`), 2) as `' . UserAggregate::COLUMN_AVERAGE . '`'),
                \DB::raw('ROUND(stddev(`download_speed`), 2) as `' . UserAggregate::COLUMN_STANDARD_DEVIATION . '`')
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

    public function getAggregatesByTimestamp(User $user = null, $durationInDays = 7, $roundDuration = 21600)
    {
        $query = \DB::table('tests')
            ->select([
                \DB::raw('ROUND(AVG(`download_speed`), 2) as `' . TimestampAggregate::COLUMN_DOWNLOAD . '`'),
                \DB::raw('ROUND(AVG(`upload_speed`), 2) AS `' . TimestampAggregate::COLUMN_UPLOAD . '`'),
                \DB::raw('ROUND(AVG(`ping`)) AS `' . TimestampAggregate::COLUMN_PING . '`'),
                \DB::raw('FROM_UNIXTIME((UNIX_TIMESTAMP(`tests`.`created_at`) DIV ' . $roundDuration . ') * ' . $roundDuration . ') AS `' . TimestampAggregate::COLUMN_DATE . '`'),
                \DB::raw('ROUND(STDDEV(`download_speed`), 2) as `' . TimestampAggregate::COLUMN_DOWNLOAD_SD . '`'),
                \DB::raw('ROUND(STDDEV(`upload_speed`), 2) as `' . TimestampAggregate::COLUMN_UPLOAD_SD . '`'),
                \DB::raw('ROUND(STDDEV(`ping`)) as `' . TimestampAggregate::COLUMN_PING_SD . '`')
            ])
            ->from('tests')
            ->join('devices', 'tests.device_id', '=', 'devices.id');

        if (!is_null($user)) {
            $query->where('devices.user_id', '=', $user->id);
        }
        
        return $query->where('tests.created_at', '>', \DB::raw('DATE_SUB(DATE_FORMAT(NOW(),"%Y-%m-%d 23:59:59"), INTERVAL ' . $durationInDays . ' DAY)'))
            ->groupBy('devices.user_id', TimestampAggregate::COLUMN_DATE)
            ->get();
    }

}