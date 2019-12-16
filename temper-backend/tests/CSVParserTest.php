<?php


namespace Test;



use App\Entity\User;
use App\Parser\CSVUserParser;;
use App\Validator\Validator;
use Exception;
use PHPUnit\Framework\TestCase;

class CSVParserTest extends TestCase
{
    public function testWrongSizeForInput(){
        $csv_parser = new CSVUserParser(new Validator());
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Each data row must contain at least five elements\r\n");
        $csv_parser->parse([
            ['1','01.12.1950']
        ]);

    }

    public function testRightInput(){
        $csv_parser = new CSVUserParser(new Validator());;
        $user_1 = new User("1","2016-07-19","20","0","0");
        $user_2 = new User("2","2016-07-19","50","0","0");
        $csv_parser->parse([
            array("user_id"=>"1","created_at"=>"2016-07-19","onboarding_percentage"=>"20","count_applications"=>"0","count_accepted_applications"=>"0"),
            array("user_id"=>"2","created_at"=>"2016-07-19","onboarding_percentage"=>"50","count_applications"=>"0","count_accepted_applications"=>"0")
        ]);
        $this->assertEquals($user_1->id,$csv_parser->entities[0]->id);
        $this->assertEquals($user_1->created_at,$csv_parser->entities[0]->created_at);
        $this->assertEquals($user_1->onboarding_percentage,$csv_parser->entities[0]->onboarding_percentage);
        $this->assertEquals($user_1->count_applications,$csv_parser->entities[0]->count_applications);
        $this->assertEquals($user_1->count_accepted_applications,$csv_parser->entities[0]->count_accepted_applications);

        $this->assertEquals($user_2->id,$csv_parser->entities[1]->id);
        $this->assertEquals($user_2->created_at,$csv_parser->entities[1]->created_at);
        $this->assertEquals($user_2->onboarding_percentage,$csv_parser->entities[1]->onboarding_percentage);
        $this->assertEquals($user_2->count_applications,$csv_parser->entities[1]->count_applications);
        $this->assertEquals($user_2->count_accepted_applications,$csv_parser->entities[1]->count_accepted_applications);
    }
}