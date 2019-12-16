<?php


namespace App\Helpers;


use DateInterval;
use DatePeriod;
use DateTime;
use Exception;

/**
 * Class WeekHelper
 * Helper functions for weekly cohort data.
 * @package App\Helpers
 */
class WeekHelper
{
    /**
     * @param $weekDates : start and end dates for each week in a certain period
     * @param $entities : data
     * @return array
     */
    public static function getPerWeekData($weekDates, $entities)
    {
        $data = array();
        for ($i = 0; $i < sizeof($weekDates); $i++) {
            $perWeekStepData = array([0, 0], [20, 0], [40, 0], [50, 0], [70, 0], [90, 0], [100, 0]);
            $perWeekSum = 0;
            for ($j = 0; $j < sizeof($entities); $j++) {
                if ($entities[$j]->created_at >= $weekDates[$i]['start'] && $entities[$j]->created_at <= $weekDates[$i]['end']) {
                    if ($entities[$j]->onboarding_percentage > 0) {
                        $perWeekStepData[0][1] += 1;
                    }
                    if ($entities[$j]->onboarding_percentage > 20) {
                        $perWeekStepData[1][1] += 1;
                    }
                    if ($entities[$j]->onboarding_percentage > 40) {
                        $perWeekStepData[2][1] += 1;
                    }
                    if ($entities[$j]->onboarding_percentage > 50) {
                        $perWeekStepData[3][1] += 1;
                    }
                    if ($entities[$j]->onboarding_percentage > 70) {
                        $perWeekStepData[4][1] += 1;
                    }
                    if ($entities[$j]->onboarding_percentage > 90) {
                        $perWeekStepData[5][1] += 1;
                    }
                    if ($entities[$j]->onboarding_percentage == 100) {
                        $perWeekStepData[6][1] += 1;
                    }
                    $perWeekSum += 1;
                }
            }
            $perWeekData = ['name' => $weekDates[$i]['start'], 'data' => [
                [0, 100],
                [20, round(($perWeekStepData[0][1] / $perWeekSum) * 100)],
                [40, round(($perWeekStepData[1][1] / $perWeekSum) * 100)],
                [50, round(($perWeekStepData[2][1] / $perWeekSum) * 100)],
                [70, round(($perWeekStepData[3][1] / $perWeekSum) * 100)],
                [90, round(($perWeekStepData[4][1] / $perWeekSum) * 100)],
                [99, round(($perWeekStepData[5][1] / $perWeekSum) * 100)],
                [100, round(($perWeekStepData[6][1] / $perWeekSum) * 100)]
            ]];
            array_push($data, $perWeekData);
        }
        return $data;
    }

    /**
     * Gets week dates between two dates.
     * @param $startDate
     * @param $endDate
     * @return array
     * @throws Exception
     */
    public static function getWeekDates($startDate, $endDate)
    {

        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($start, $interval, $end);

        $weekNumber = 1;
        $weeks = array();
        foreach ($dateRange as $date) {
            $weeks[$weekNumber][] = $date->format('Y-m-d');
            if ($date->format('w') == 6) {
                $weekNumber++;
            }
        }
        $ranges = array();
        foreach ($weeks as $week) {
            array_push($ranges, ['start' => array_shift($week), 'end' => array_pop($week)]);
        }
        return $ranges;
    }

    /**
     * Gets min and max dates in the data provided
     * @param $entities
     * @return array
     */
    public static function getMaxAndMinimumDate($entities)
    {
        $maxDate = $entities[0]->created_at;
        $minDate = $entities[0]->created_at;
        for ($i = 1; $i < sizeof($entities); $i++) {
            if ($entities[$i]->created_at > $maxDate) {
                $maxDate = $entities[$i]->created_at;
            }
            if ($entities[$i]->created_at < $minDate) {
                $minDate = $entities[$i]->created_at;
            }
        }
        return ['max_date' => $maxDate, 'min_date' => $minDate];
    }

}