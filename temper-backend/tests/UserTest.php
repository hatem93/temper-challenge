<?php


namespace Test;


use App\Entity\User;;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase
{
    public function testCheckCast()
    {
        $user = new User("1", "2016-07-19", "20", "0", "0");
        $user->cast();
        $this->assertEquals(is_int($user->id),true);
        $this->assertEquals(is_int($user->onboarding_percentage),true);
        $this->assertEquals(is_int($user->count_accepted_applications),true);
        $this->assertEquals(is_int($user->count_applications),true);
    }

    public function testValidateId()
    {
        $userWrongId = new User("asd", "2016-07-19", "20", "0", "0");
        $userWrongId2 = new User("-1", "2016-07-19", "20", "0", "0");
        $userRightId = new User("1", "2016-07-19", "20", "0", "0");
        $this->assertEquals($userWrongId->validate(), false);
        $this->assertEquals($userWrongId2->validate(), false);
        $this->assertEquals($userRightId->validate(), true);
    }

    public function testValidateCreatedAt()
    {
        $userWrongDate = new User("1", "asd", "20", "0", "0");
        $userRightDate = new User("1", "2016-07-19", "20", "0", "0");
        $this->assertEquals($userWrongDate->validate(), false);
        $this->assertEquals($userRightDate->validate(), true);
    }

    public function testValidateOnBoardingPercentage()
    {
        $userWrong = new User("1", "2016-07-19", "asd", "0", "0");
        $userWrong2 = new User("1", "2016-07-19", "-1", "0", "0");
        $userWrong3 = new User("1", "2016-07-19", "101", "0", "0");
        $userRight = new User("1", "2016-07-19", "20", "0", "0");
        $this->assertEquals($userWrong->validate(), false);
        $this->assertEquals($userWrong2->validate(), false);
        $this->assertEquals($userWrong3->validate(), false);
        $this->assertEquals($userRight->validate(), true);
    }

    public function testValidateCountApplication()
    {
        $userWrong = new User("1", "2016-07-19", "20", "asd", "0");
        $userWrong2 = new User("1", "2016-07-19", "20", "-1", "0");
        $userRight = new User("1", "2016-07-19", "20", "20", "0");
        $this->assertEquals($userWrong->validate(), false);
        $this->assertEquals($userWrong2->validate(), false);
        $this->assertEquals($userRight->validate(), true);
    }

    public function testValidateCountAcceptedApplications()
    {
        $userWrong = new User("1", "2016-07-19", "20", "0", "asd");
        $userWrong2 = new User("1", "2016-07-19", "20", "0", "-1");
        $userRight = new User("1", "2016-07-19", "20", "0", "20");
        $this->assertEquals($userWrong->validate(), false);
        $this->assertEquals($userWrong2->validate(), false);
        $this->assertEquals($userRight->validate(), true);
    }
}