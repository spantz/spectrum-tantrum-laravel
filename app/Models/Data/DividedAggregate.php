<?php


namespace App\Models\Data;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class DividedAggregate implements Jsonable, Arrayable, \JsonSerializable, CanBeEmpty
{
    use ChecksNotEmpty;

    const COLUMN_DOWNLOAD = 'down';
    const COLUMN_UPLOAD = 'up';
    const COLUMN_DATE = 'date';
    const COLUMN_PING = 'ping';
    const COLUMN_DOWNLOAD_SD = 'downStandardDeviation';
    const COLUMN_UPLOAD_SD = 'upStandardDeviation';
    const COLUMN_PING_SD = 'pingStandardDeviation';

    private $down;
    private $up;
    private $date;
    private $ping;
    private $downStandardDeviation;
    private $upStandardDeviation;
    private $pingStandardDeviation;

    function __construct(\stdClass $rawResult = null)
    {
        if (!is_null($rawResult)) {
            $this->{static::COLUMN_DOWNLOAD} = $rawResult->{static::COLUMN_DOWNLOAD};
            $this->{static::COLUMN_UPLOAD} = $rawResult->{static::COLUMN_UPLOAD};
            $this->{static::COLUMN_DATE} = $rawResult->{static::COLUMN_DATE};
            $this->{static::COLUMN_PING} = $rawResult->{static::COLUMN_PING};
            $this->{static::COLUMN_DOWNLOAD_SD} = $rawResult->{static::COLUMN_DOWNLOAD_SD};
            $this->{static::COLUMN_UPLOAD_SD}= $rawResult->{static::COLUMN_UPLOAD_SD};
            $this->{static::COLUMN_PING_SD} = $rawResult->{static::COLUMN_PING_SD};
        }
    }

    /**
     * @return float
     */
    public function getDownload()
    {
        return $this->down;
    }

    /**
     * @return float
     */
    public function getUpload()
    {
        return $this->up;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return float
     */
    public function getPing()
    {
        return $this->ping;
    }

    /**
     * @return mixed
     */
    public function getDownSD()
    {
        return $this->downStandardDeviation;
    }

    /**
     * @return mixed
     */
    public function getUpSD()
    {
        return $this->upStandardDeviation;
    }

    /**
     * @return mixed
     */
    public function getPingSD()
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
            static::COLUMN_DOWNLOAD => $this->getDownload(),
            static::COLUMN_UPLOAD => $this->getUpload(),
            static::COLUMN_DATE => $this->getDate(),
            static::COLUMN_PING => $this->getPing(),
            static::COLUMN_DOWNLOAD_SD => $this->getDownSD(),
            static::COLUMN_UPLOAD_SD => $this->getUpSD(),
            static::COLUMN_PING_SD => $this->getPingSD()
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