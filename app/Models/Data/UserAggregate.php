<?php


namespace App\Models\Data;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class UserAggregate implements Jsonable, \JsonSerializable, Arrayable, CanBeEmpty
{
    use ChecksNotEmpty;

    const COLUMN_MAX = 'max';
    const COLUMN_MIN = 'min';
    const COLUMN_AVERAGE = 'average';
    const COLUMN_STANDARD_DEVIATION = 'standardDeviation';

    private $max;
    private $min;
    private $average;
    private $standardDeviation;

    function __construct(\stdClass $rawResult = null)
    {
        if (!is_null($rawResult)) {
            $this->max = $rawResult->max;
            $this->min = $rawResult->min;
            $this->average = $rawResult->average;
            $this->standardDeviation = $rawResult->standardDeviation;
        }
    }

    /**
     * @return mixed
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return mixed
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return mixed
     */
    public function getAverage()
    {
        return $this->average;
    }

    /**
     * @return mixed
     */
    public function getStandardDeviation()
    {
        return $this->standardDeviation;
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
            static::COLUMN_MAX => $this->getMax(),
            static::COLUMN_MIN => $this->getMin(),
            static::COLUMN_AVERAGE => $this->getAverage(),
            static::COLUMN_STANDARD_DEVIATION => $this->getStandardDeviation()
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