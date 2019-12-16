<?php


namespace App;


use App\Controller\ChartController;
use App\Reader\ReaderFactory;
use Exception;

class Router
{
    /**
     * Function that routes all the request.
     * @throws Exception
     */
    public static function route (){
        $request = $_SERVER['REQUEST_URI'];

        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            echo Response::optionsResponse();
        }
        else{
            switch ($request) {
                case '/' :
                    echo "Server is Alive!";
                    break;
                case '' :
                    echo "Server2 is Alive!";
                    break;
                case '/charts' :
                    $chartController = new ChartController(new ReaderFactory(),"csv","public/export.csv");
                    $chartController->getWeeklyCohortChartData();
                    break;
                default:
                    echo "Route Not Found!";
                    break;
            }
        }
    }
}