<?php


namespace Test;


use App\Reader\CSVReader;
use App\Reader\ReaderFactory;
use Exception;
use PHPUnit\Framework\TestCase;

class CSVReaderFactoryTest extends TestCase
{
    function testUnSupportedFormat(){
        $readerFactory = new ReaderFactory();
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("There is no reader with this type\r\n");
        $readerFactory->createReader("wrong","public/file_1.wrong");
    }

    function testCSVFormat(){
        $readerFactory = new ReaderFactory();
        $outputReader = $readerFactory->createReader("csv","public/file_1.csv");
        $this->assertInstanceOf(CSVReader::class,$outputReader);
    }
}