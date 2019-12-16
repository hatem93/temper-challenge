<?php


namespace Test;


use App\Parser\CSVUserParser;
use App\Reader\CSVReader;
use App\Validator\Validator;
use Exception;
use PHPUnit\Framework\TestCase;

class CSVReaderTest extends TestCase
{
    public function testFileNotFound(){
        $csv_reader = new CSVReader(new CSVUserParser(new Validator()),"public/users_not_found.csv");
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Couldn't open file with path "."public/users_not_found.csv"."\r\n");
        $csv_reader->readFile();
    }

    public function testFileNotCSV(){
        $csv_reader = new CSVReader(new CSVUserParser(new Validator()),"public/user_wrong_extension.txt");
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("File must be a csv\r\n");
        $csv_reader->readFile();
    }

    public function testReadCSVFile(){
        $csv_reader = new CSVReader(new CSVUserParser(new Validator()),"public/export.csv");
        $output = $csv_reader->readFile();
        $this->assertEquals(sizeof($output),339);
    }
}