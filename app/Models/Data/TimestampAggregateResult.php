<?php


namespace App\Models\Data;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;

class TimestampAggregateResult implements \JsonSerializable, Jsonable, Arrayable
{
    private $dates;
    private $down;
    private $up;
    private $ping;
    private $downSD;
    private $upSD;
    private $pingSD;

    function __construct(Collection $dates, Collection $down, Collection $up, Collection $ping, Collection $downSD, Collection $upSD, Collection $pingSD)
    {
        $this->dates = $dates;
        $this->down = $down;
        $this->up = $up;
        $this->ping = $ping;
        $this->downSD = $downSD;
        $this->upSD = $upSD;
        $this->pingSD = $pingSD;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'dates' => $this->dates,
            'down' => $this->down,
            'up' => $this->up,
            'ping' => $this->ping,
            'downSD' => $this->downSD,
            'upSD' => $this->upSD,
            'pingSD' => $this->pingSD
        ];
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return $this->toArray();
    }
}