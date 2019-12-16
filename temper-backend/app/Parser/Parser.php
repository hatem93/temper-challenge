<?php


namespace App\Parser;


use App\Validator\Validator;

/**
 * Class Parser
 * @package App\Parser
 */
abstract class Parser
{
    public $validator;
    public $entities = [];

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $data the data from the reader
     * @return mixed
     */
    public abstract function parse($data);
}