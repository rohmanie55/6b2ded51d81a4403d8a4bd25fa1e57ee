<?php

function config($param=null) : array{
    $config = [
        'database' => [
            'host'  => getenv('DB_HOST'),
            'dbname'=>getenv('DB_NAME'),
            'username'=>getenv('DB_USER'),
            'password'=>getenv('DB_PASSWORD')
        ],
        'mail' => [
            'host' => getenv('MAIL_HOST'),
            'auth' => getenv('MAIL_AUTH'),
            'port' => getenv('MAIL_PORT'),
            'username' => getenv('MAIL_USERNAME'),
            'password' => getenv('MAIL_PASSWORD')
        ]
    ];

    if($param){
        return $config[$param];
    }
    return $config;
}