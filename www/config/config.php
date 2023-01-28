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
            'port' => getenv('MAIL_PORT'),
            'username' => getenv('MAIL_USERNAME'),
            'password' => getenv('MAIL_PASSWORD')
        ],
        'rabitmq' => [
            'host' => getenv('RABBITMQ_HOST'),
            'port' => getenv('RABBITMQ_PORT'),
            'username' => getenv('RABBITMQ_USER'),
            'password' => getenv('RABBITMQ_PASSWORD')
        ],
        'jwt' => [
            'secret'=> getenv('JWT_SECRET'),
            'client_id'=> getenv('JWT_CLIENT_ID'),
            'client_secret'=> getenv('JWT_CLIENT_SECRET'),
        ]
    ];

    if($param){
        return $config[$param];
    }
    return $config;
}