<?php


namespace App\Reader;


use App\Parser\Parser;

/**
 * Class Reader
 * @package App\Reader
 */
abstract class Reader
{
    public $parser;
    public $file;

    /**
     * Reader constructor.
     * @param Parser $parser
     * @param $file file path and name
     */
    public function __construct(Parser $parser, $file)
    {
        $this->parser = $parser;
        $this->file = $file;
    }

    public abstract function readFile();
}