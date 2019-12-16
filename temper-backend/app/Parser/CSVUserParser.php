<?php


namespace App\Parser;

use App\Entity\User;
use Exception;

/**
 * Class CSVUserParser
 * @package App\Parser
 */
class CSVUserParser Extends Parser
{
    /**
     * @param $data csv_data from the CSVReader
     * @throws Exception
     */
    public function parse($data)
    {
        foreach ($data as $entry) {
            if (sizeof($entry) < 5)
                throw new Exception("Each data row must contain at least five elements\r\n");
            array_push(
                $this->entities,
                new User(
                    $entry["user_id"],
                    $entry["created_at"],
                    $entry["onboarding_percentage"],
                    $entry["count_applications"],
                    $entry["count_accepted_applications"]
                )
            );
        }
    }
}