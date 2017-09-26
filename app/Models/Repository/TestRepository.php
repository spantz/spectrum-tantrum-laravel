<?php


namespace App\Models\Repository;


use App\Models\Data\TimestampAggregate;
use App\Models\Data\OverviewAggregate;
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

    /**
     * Retrieves aggregates for a collection of users.
     *
     * @param Collection|null $users
     * @param int $durationInDays
     * @return Collection
     */
    public function getAggregatesForUsers(Collection $users = null, $durationInDays = 7): Collection
    {
        $query = \DB::table('tests')
            ->select([
                \DB::raw('ROUND(avg(`download_speed`), 2) as `' . OverviewAggregate::DOWNLOAD_AVG . '`'),
                \DB::raw('ROUND(avg(`upload_speed`), 2) as `' . OverviewAggregate::UPLOAD_AVG . '`'),
                \DB::raw('ROUND(avg(`ping`), 2) as `' . OverviewAggregate::PING_AVG . '`'),
                \DB::raw('ROUND(stddev(`download_speed`), 2) as `' . OverviewAggregate::DOWNLOAD_STDEV . '`'),
                \DB::raw('ROUND(stddev(`upload_speed`), 2) as `' . OverviewAggregate::UPLOAD_STDEV . '`'),
                \DB::raw('ROUND(stddev(`ping`), 2) as `' . OverviewAggregate::PING_STDEV . '`')
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

    /**
     * Retrieves aggregates, broken down by durations of time.
     *
     * @param User|null $user
     * @param int $durationInDays - the duration of days, counting back, that aggregates are queried for.
     * @param float $roundDurationInDays - the length of time the aggregates will be rounded to (i.e. .25 is every 6 hours)
     * @return Collection
     */
    public function getAggregatesByTimestamp(User $user = null, $durationInDays = 7, $roundDurationInDays = .25)
    {
        $roundDurationInSeconds = $roundDurationInDays * (3600 * 24);

        $query = \DB::table('tests')
            ->select([
                \DB::raw('ROUND(AVG(`download_speed`), 2) as `' . TimestampAggregate::COLUMN_DOWNLOAD . '`'),
                \DB::raw('ROUND(AVG(`upload_speed`), 2) AS `' . TimestampAggregate::COLUMN_UPLOAD . '`'),
                \DB::raw('ROUND(AVG(`ping`)) AS `' . TimestampAggregate::COLUMN_PING . '`'),
                \DB::raw('FROM_UNIXTIME((UNIX_TIMESTAMP(`tests`.`created_at`) DIV ' . $roundDurationInSeconds . ') * ' . $roundDurationInSeconds . ') AS `' . TimestampAggregate::COLUMN_DATE . '`'),
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