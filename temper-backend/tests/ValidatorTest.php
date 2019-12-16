<?php


namespace Tests;

use App\Entity\User;
use App\Validator\Validator;
use PHPUnit\Framework\TestCase;
use Exception;


class ValidatorTest extends TestCase
{

    public function testNotValidatableEntities(){
        $validator = new Validator();
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("The entities provided is not of type ValidatableEntity\r\n");
        $validator->validate([1,2,3]);
    }

    public function testUnValidUserEntities(){
        $validator = new Validator();
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("The entities provided are not valid\r\n");
        $validator->validate([
            new User("asd", "2016-07-19", "20", "0", "0")
        ]);
    }

    public function testValidUserEntities(){
        $validator = new Validator();
        $outputEntities = $validator->validate([
            new User("1", "2016-07-19", "20", "0", "0"),
            new User("1", "2016-07-19", "20", "20", "0")
        ]);
        $this->assertEquals(sizeof($outputEntities),2);
    }
}