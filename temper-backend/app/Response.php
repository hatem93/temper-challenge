<?php


namespace App;

define("BAD_REQUEST_EXCEPTION", 400);
define("OK", 200);
define("INTERNAL_SERVER_ERROR", 500);
define("UNPROCESSABLE_ENTITY", 422);

/**
 * Class Response
 * Class that is responsible for creating a response
 * @package App
 */
class Response
{
    /**
     * Function that creates a json response with a certain message and status code.
     * @param null $message
     * @param int $code
     * @return string
     */
    public static function jsonResponse($message = null, $code = OK)
    {
        header_remove();
        http_response_code($code);
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        Response::includeCORSHeaders();
        $status = array(
            OK => '200 OK',
            BAD_REQUEST_EXCEPTION => '400 Bad Request',
            UNPROCESSABLE_ENTITY => 'Unprocessable Entity',
            INTERNAL_SERVER_ERROR => '500 Internal Server Error'
        );
        header('Status: ' . $status[$code]);
        return json_encode(array(
            'status' => $code < 300, // success or not?
            'message' => $message
        ));
    }

    /**
     * Function that handles OPTIONS request
     * @return false|string
     */
    public static function optionsResponse()
    {
        header_remove();
        http_response_code(200);
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        Response::includeCORSHeaders();
        return json_encode(array(
            'status' => 200
        ));
    }

    /**
     * Function that includes all the CORS headers
     */
    public static function includeCORSHeaders()
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, PUT, OPTIONS, DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods, Access-Control-Allow-Origin, Origin, Accept, Content-Type');
    }
}