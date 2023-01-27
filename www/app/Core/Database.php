<?php

namespace Simple\Mail\App\Core;

class Database
{
    private $conn = null;

    public function connect(string $confName = 'database'){
        $config = config($confName);
        if($this->conn == null){
            $dsn = "pgsql:host={$config['host']};port=5432;dbname={$config['dbname']};";

            $this->conn = new \PDO($dsn,
                $config['username'],
                $config['password'],
                [\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION]
            );
        }
        return $this->conn;
    }
}
