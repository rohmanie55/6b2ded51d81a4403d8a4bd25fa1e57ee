<?php
namespace Simple\Mail\App\Console;

use Simple\Mail\App\Core\Mailer;
use Simple\Mail\App\Core\Queue;
use Simple\Mail\App\Model\MailLog;

class MailHandler{
    public const MAIL_TOPIC = 'mail_queue';

    public static function run(){
        $queue = new Queue();
        $queue->subsribe(self::MAIL_TOPIC,function($msg){
            echo ' [x] Received ', $msg->body, "\n";
            $data   = json_decode($msg->body);
            $mailer = new Mailer();
            $mailer->from($data->from)
                    ->to($data->to)
                    ->subject($data->subject)
                    ->body($data->body, @$data->view);
            $sendStatus = $mailer->send();

            $mailLog = new MailLog();
            $mailLog->insert([
                'subject' => $data->subject, 
                'send_to' => $data->to, 
                'body' => is_string($data->body) ? $data->body : json_encode($data->body), 
                'status' => $sendStatus
            ]);
        });

        while ($queue->channel->is_open()) {
            $queue->channel->wait();
        }
    }
}