<?php


namespace App\Entity;

use Exception;
use DateTime;

class User implements ValidatableEntity
{
    public $id;
    public $created_at;
    public $onboarding_percentage;
    public $count_applications;
    public $count_accepted_applications;

    /**
     * User constructor.
     * @param $id
     * @param $created_at
     * @param $onboarding_percentage
     * @param $count_applications
     * @param $count_accepted_applications
     */
    public function __construct($id, $created_at, $onboarding_percentage, $count_applications, $count_accepted_applications)
    {
        $this->id = $id;
        $this->created_at = $created_at;
        $this->onboarding_percentage = $onboarding_percentage;
        $this->count_applications = $count_applications;
        $this->count_accepted_applications = $count_accepted_applications;
    }

    /**
     * Cast function casts the data to the right types after validation.
     */
    public function cast()
    {
        $this->id = (int)$this->id;
        $this->onboarding_percentage = (int)$this->onboarding_percentage;
        $this->count_applications = (int)$this->count_applications;
        $this->count_accepted_applications = (int)$this->count_accepted_applications;
    }

    /**
     * Validate function , validates User attributes.
     * @return bool
     */
    public function validate()
    {
        return $this->validateId()
            && $this->validateCreatedAt()
            && $this->validateOnBoardingPercentage()
            && $this->validateCountApplication()
            && $this->validateCountAcceptedApplications();
    }

    /**
     * Validates that id is an int and is bigger than 1.
     * @return bool
     */
    private function validateId()
    {
        return is_numeric($this->id) && (int)$this->id >= 1;
    }

    /**
     * Validates that created at is a date.
     * @return bool
     */
    private function validateCreatedAt()
    {
        try {
            new DateTime($this->created_at);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Validates that on boarding percentage is int and between 0 and 100.
     * @return bool
     */
    private function validateOnBoardingPercentage()
    {
        return is_numeric($this->onboarding_percentage) && (int)$this->onboarding_percentage >= 0 && (int)$this->onboarding_percentage <= 100;
    }

    /**
     * Validates that applications count is int and positive.
     * @return bool
     */
    private function validateCountApplication()
    {
        return is_numeric($this->count_applications) && (int)$this->count_applications >= 0;
    }

    /**
     * Validates that accepted applications count is int and positive.
     * @return bool
     */
    private function validateCountAcceptedApplications()
    {
        return is_numeric($this->count_accepted_applications) && (int)$this->count_accepted_applications >= 0;
    }
}
