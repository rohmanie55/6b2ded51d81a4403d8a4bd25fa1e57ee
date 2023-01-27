<?php

namespace Simple\Mail\App\Core;

class Model extends Database
{
    protected $db;
    protected $database_conf = 'database';
    
    public function __construct()
    {
        $this->db = $this->connect($this->database_conf);
    }
}