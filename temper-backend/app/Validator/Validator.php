<?php


namespace App\Validator;


use App\Entity\ValidatableEntity;
use Exception;

class Validator
{
    public function validate($entities)
    {
        for ($i = 0; $i < sizeof($entities); $i++) {
            if ($entities[$i] instanceof ValidatableEntity) {
                if ($entities[$i]->validate()) {
                    $entities[$i]->cast();
                } else {
                    throw new Exception("The entities provided are not valid\r\n");
                }
            } else {
                throw new Exception("The entities provided is not of type ValidatableEntity\r\n");
            }
        }
        return $entities;
    }
}