<?php


namespace App\Models\Data;


class TimestampAggregate
{
    const COLUMN_DOWNLOAD = 'download';
    const COLUMN_UPLOAD = 'upload';
    const COLUMN_DATE = 'date';

    private $download;
    private $upload;
    private $date;

    function __construct(\stdClass $rawResult)
    {
        if (!is_null($rawResult)) {
            $this->download = $rawResult->download;
            $this->upload = $rawResult->upload;
            $this->date = $rawResult->date;
        }
    }

    /**
     * @return float
     */
    public function getDownload()
    {
        return $this->download;
    }

    /**
     * @return float
     */
    public function getUpload()
    {
        return $this->upload;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
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
        return $this->toJson();
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return [
            static::COLUMN_DOWNLOAD => $this->getDownload(),
            static::COLUMN_UPLOAD => $this->getUpload(),
            static::COLUMN_DATE => $this->getDate()
        ];
    }

}