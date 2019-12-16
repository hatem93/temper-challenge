<?php


namespace App\Reader;


use App\Parser\CSVUserParser;
use App\Validator\CSVValidator;
use App\Validator\Validator;
use Exception;

/**
 * Class ReaderFactory
 * @package App\Reader
 */
class ReaderFactory
{
    /**
     * @param $type the type of the reader [csv]
     * @param $file the path and name of file
     * @return CSVReader
     * @throws Exception
     */
    public function createReader($type, $file)
    {
        switch ($type) {
            case "csv":
                return new CSVReader(new CSVUserParser(new Validator()), $file);
            default:
                throw new Exception("There is no reader with this type\r\n");
        }
    }
}