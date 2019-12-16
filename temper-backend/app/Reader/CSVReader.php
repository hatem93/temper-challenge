<?php


namespace App\Reader;


use Exception;

/**
 * Class CSVReader
 * @package App\Reader
 */
class CSVReader extends Reader
{
    /**
     * Reads a csv file and does some checks on it.
     * @return array
     * @throws Exception
     */
    public function readFile()
    {
        if (!preg_match("/\.(csv)$/", $this->file))
            throw new Exception("File must be a csv\r\n");
        if (!file_exists($this->file) || !is_readable($this->file))
            throw new Exception("Couldn't open file with path " . $this->file . "\r\n");


        $handle = fopen($this->file, 'r');
        $head = fgetcsv($handle, 4096, ';');
        $data = array();
        while ($column = fgetcsv($handle, 4096, ';')) {
            $data[] = array_combine($head, $column);
        }
        fclose($handle);
        return $data;
    }

}