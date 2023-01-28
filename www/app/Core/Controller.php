<?php
namespace Simple\Mail\App\Core;

class Controller 
{
    protected const DEFAULT_FORMAT = "application/json";
    protected const CREATED      = 201;
    protected const NO_CONTENT   = 204;
    protected const BAD_REQUEST  = 400;
    protected const UNAUTHORIZED = 401;
    protected const FORBIDEN     = 403;
    protected const NOT_FOUND    = 404;
    protected const UNPROCESSABLE= 422;
    protected const SERVER_ERROR = 500;

    public function __construct()
    {
        $this->cors();
    }

    protected function response($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: '.self::DEFAULT_FORMAT.'; charset=utf-8');
        echo $this->toJson($data);
        die;
    }

    protected function toJson($data){
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    protected function input($key=null){
        $input = $_REQUEST;
        if (@$_SERVER["CONTENT_TYPE"] == self::DEFAULT_FORMAT) {
            $input = json_decode(file_get_contents('php://input'), true);
        }

        return isset($input[$key]) ? $input[$key] : $input;
    }

    private function cors()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Max-Age: 86400");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    }
}