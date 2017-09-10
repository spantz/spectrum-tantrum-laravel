<?php


namespace App\Models\Data;


/**
 * Marks an object as being able to be empty.
 * Adds two methods, isEmpty and isNotEmpty, to determine whether
 * or not the object is empty.
 *
 * Interface CanBeEmpty
 * @package App\Models\Data
 */
interface CanBeEmpty
{
    /**
     * Determines whether or not this object is empty.
     * @see CanBeEmpty::isNotEmpty() for the inverse.
     *
     * @return bool true if empty, false if not empty.
     */
    public function isEmpty(): bool;

    /**
     * Determines whether or not this object is NOT empty.
     * @see CanBeEmpty::isEmpty() for the inverse.
     *
     * @return bool true if not empty, false if empty.
     */
    public function isNotEmpty(): bool;

}