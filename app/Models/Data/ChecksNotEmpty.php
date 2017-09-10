<?php


namespace App\Models\Data;


/**
 * A trait meant to be used with the CanBeEmpty interface.
 * Makes isNotEmpty just return the inverse of isEmpty without
 * having to rewrite it over and over.
 * @see CanBeEmpty
 *
 * Trait ChecksNotEmpty
 * @package App\Models\Data
 */
trait ChecksNotEmpty
{
    /**
     * @see CanBeEmpty::isNotEmpty()
     */
    public function isNotEmpty(): bool
    {
       return !$this->isEmpty();
    }

}