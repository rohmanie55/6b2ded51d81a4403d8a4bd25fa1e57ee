<?php

namespace Simple\Mail\App\Controller;

use Simple\Mail\App\Console\MailHandler;
use Simple\Mail\App\Core\Controller;
use Simple\Mail\App\Core\Queue;
use Simple\Mail\App\Model\MailLog;

class MailController extends Controller
{
  protected $mail;

  public function __construct()
  {
      $this->mail = new MailLog;
  }

  public function index()
  {
    $this->response([
      'status'=>'OK',
      'data'=>$this->mail->paginate(10)
    ]);
  }

  public function store(){
    $queue = new Queue();

    $queue->publish(MailHandler::MAIL_TOPIC, [
      'from'=> $this->input('from'),
      'to'=> $this->input('to'),
      'subject'=> $this->input('subject'),
      'body'=> $this->input('body')
    ]);

    return $this->response([
      'status'=>'OK',
      'message'=>'Successfull send mail!'
    ]);
  }
}