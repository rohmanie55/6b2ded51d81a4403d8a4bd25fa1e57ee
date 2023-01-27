<?php

namespace Simple\Mail\App\Controller;

use Simple\Mail\App\Core\Controller;
use Simple\Mail\App\Core\Mailer;
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
    $mailer = new Mailer();
    $mailer->from('mrohmani96@gmail.com')
            ->to('rohmanie55@gmail.com')
            ->subject('test kirim email!')
            ->body('mail-default', []);
    die(var_dump($mailer->send()));
    $this->response([
      'status'=>'OK',
      'data'=>$this->mail->all()
    ]);
  }
}