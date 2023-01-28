<?php
namespace Simple\Mail\App\Core;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token{
    protected $key;
    protected $secret;

    public function __construct()
    {
        $this->secret = config('jwt')['secret'];
        $this->key = new Key($this->secret, 'HS256');
    }

    public static function verify(){
        $headers = getallheaders();
        if(!isset($headers['Authorization'])){
            http_response_code(400);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                "message"=>"Token Required!"
            ]);
            die;
        }
        $token   = $headers['Authorization'];
        $token   = explode(" ", $token)[1];

        try {
            $decoded = JWT::decode($token, (new self)->key);
        } catch (\Throwable $th) {
            http_response_code(500);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                "message"=>"Invalid token!"
            ]);
            die;
        }

        return $decoded;
    }

    public static function generete($costumPayload=[]){
        $payload['iss'] = $_SERVER['HTTP_HOST'];
        $payload['iat'] = time();
        $payload['nbf'] = time();
        $payload['exp'] = strtotime('365 days');
     
        return JWT::encode(array_merge($payload,$costumPayload), (new self)->secret, 'HS256');
    }
}