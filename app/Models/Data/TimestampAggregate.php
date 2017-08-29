<?php


namespace App\Models\Data;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class TimestampAggregate implements Jsonable, Arrayable, \JsonSerializable
{
    const COLUMN_DOWNLOAD = 'down';
    const COLUMN_UPLOAD = 'up';
    const COLUMN_DATE = 'date';
    const COLUMN_PING = 'ping';
    const COLUMN_DOWNLOAD_SD = 'downSD';
    const COLUMN_UPLOAD_SD = 'upSD';
    const COLUMN_PING_SD = 'pingSD';

    private $down;
    private $up;
    private $date;
    private $ping;
    private $downSD;
    private $upSD;
    private $pingSD;

    function __construct(\stdClass $rawResult)
    {
        if (!is_null($rawResult)) {
            $this->down = $rawResult->down;
            $this->up = $rawResult->up;
            $this->date = $rawResult->date;
            $this->ping = $rawResult->ping;
            $this->downSD = $rawResult->downSD;
            $this->upSD = $rawResult->upSD;
            $this->pingSD = $rawResult->pingSD;
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
        return $this->downSD;
    }

    /**
     * @return mixed
     */
    public function getUpSD()
    {
        return $this->upSD;
    }

    /**
     * @return mixed
     */
    public function getPingSD()
    {
        return $this->pingSD;
    }

    /**
     * {@inheritdoc}
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
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

}