<?php


namespace App\Models\Data;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class OverviewAggregate implements Jsonable, \JsonSerializable, Arrayable, CanBeEmpty
{
    use ChecksNotEmpty;

    const DOWNLOAD_AVG = 'download_average';
    const UPLOAD_AVG = 'upload_average';
    const PING_AVG = 'ping_average';
    const DOWNLOAD_STDEV = 'download_stdev';
    const UPLOAD_STDEV = 'upload_stdev';
    const PING_STDEV = 'ping_stdev';

    private $downloadAverage;
    private $uploadAverage;
    private $pingAverage;
    private $downloadStandardDeviation;
    private $uploadStandardDeviation;
    private $pingStandardDeviation;

    function __construct(\stdClass $rawResult = null)
    {
        if (!is_null($rawResult)) {
            $this->downloadAverage = $rawResult->{static::DOWNLOAD_AVG};
            $this->uploadAverage = $rawResult->{static::UPLOAD_AVG};
            $this->pingAverage = $rawResult->{static::PING_AVG};
            $this->downloadStandardDeviation = $rawResult->{static::DOWNLOAD_STDEV};
            $this->uploadStandardDeviation = $rawResult->{static::UPLOAD_STDEV};
            $this->pingStandardDeviation = $rawResult->{static::PING_STDEV};
        }
    }

    /**
     * @return mixed
     */
    public function getDownloadAverage()
    {
        return $this->downloadAverage;
    }

    /**
     * @return mixed
     */
    public function getUploadAverage()
    {
        return $this->uploadAverage;
    }

    /**
     * @return mixed
     */
    public function getPingAverage()
    {
        return $this->pingAverage;
    }

    /**
     * @return mixed
     */
    public function getDownloadStandardDeviation()
    {
        return $this->downloadStandardDeviation;
    }

    /**
     * @return mixed
     */
    public function getUploadStandardDeviation()
    {
        return $this->uploadStandardDeviation;
    }

    /**
     * @return mixed
     */
    public function getPingStandardDeviation()
    {
        return $this->pingStandardDeviation;
    }

    /**
     * {@inheritdoc}
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * {@inheritdoc}
     */
    function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return [
            static::DOWNLOAD_AVG => $this->getDownloadAverage(),
            static::UPLOAD_AVG => $this->getUploadAverage(),
            static::PING_AVG => $this->getPingAverage(),
            static::DOWNLOAD_STDEV => $this->getDownloadStandardDeviation(),
            static::UPLOAD_STDEV => $this->getUploadStandardDeviation(),
            static::PING_STDEV => $this->getPingStandardDeviation()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty(): bool
    {
        return empty(array_filter($this->toArray(), function ($item) {
            return !is_null($item);
        }));
    }
}