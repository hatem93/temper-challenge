<?php


namespace App\Entity;

/**
 * Interface ValidatableEntity
 * Interface that will be implemented by any entity that needs validation.
 * @package App\Entity
 */
interface ValidatableEntity
{
    public function validate();
}