<?php


namespace App\Controller;


use App\Helpers\WeekHelper;
use App\Reader\ReaderFactory;
use App\Response;
use Exception;

class ChartController
{
    public $reader;

    /**
     * ChartController constructor.
     * @param ReaderFactory $readerFactory
     * @param $readerType
     * @param $filePath
     * @throws Exception
     */
    public function __construct(ReaderFactory $readerFactory, $readerType, $filePath)
    {
        $this->reader = $readerFactory->createReader($readerType, $filePath);
        $fileData = $this->reader->readFile();
        $this->reader->parser->parse($fileData);
    }

    /**
     * getWeeklyCohortGraphData
     * Gets the graph data from the entities provided in the csv file.
     */
    public function getWeeklyCohortChartData()
    {
        try {
            $this->reader->parser->entities = $this->reader->parser->validator->validate($this->reader->parser->entities);
            $min_max_dates = WeekHelper::getMaxAndMinimumDate($this->reader->parser->entities);
            $week_dates = WeekHelper::getWeekDates($min_max_dates['min_date'], $min_max_dates['max_date']);
            $per_week_data = WeekHelper::getPerWeekData($week_dates, $this->reader->parser->entities);
            echo Response::jsonResponse($per_week_data);
        } catch (Exception $exception) {
            echo Response::jsonResponse($exception->getMessage(), BAD_REQUEST_EXCEPTION);
        }
    }

}