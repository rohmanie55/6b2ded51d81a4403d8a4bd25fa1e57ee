<?php
namespace Simple\Mail\App\Core;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Queue{
    private $conn;
    public $channel;

    public function __construct()
    {
        $config = config('rabitmq');
        $this->conn =  new AMQPStreamConnection($config['host'], $config['port'], $config['username'], $config['password']);
        $this->channel = $this->conn->channel();
    }

    public function publish($topic, $data){
        $this->channel->queue_declare($topic, false, false, false, false);
        $message = new AMQPMessage(json_encode(@$data));

        $status = $this->channel->basic_publish($message,'',$topic);

        $this->channel->close();
        $this->conn->close();
    }

    public function subsribe($topic, $callback){
        $this->channel->queue_declare($topic, false, false, false, false);

        echo "[*] Waiting for messages. To exit press CTRL+C\n";

        $this->channel->basic_consume($topic,'', false, true, false, false, $callback);
    }
}