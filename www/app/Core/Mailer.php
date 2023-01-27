<?php
namespace Simple\Mail\App\Core;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer{
    protected $mail;

    public function __construct()
    {
        $config = config('mail');

        $this->mail = new PHPMailer(true);
        $this->mail->IsSMTP();
        $this->mail->Host = $config['host'];
        $this->mail->Port = $config['port'];
        $this->mail->SMTPDebug = 2;
        $this->mail->SMTPAuth = true;
    }

    public function to($email){
        $this->mail->addAddress($email);
        return $this;
    }

    public function from($email){
        $this->mail->setFrom($email);
        return $this;
    }

    public function subject($subject){
        $this->mail->Subject = $subject;
        return $this;
    }

    public function body($template, $data){
        $this->mail->isHTML(true);
        $this->mail->Body= 'Hello world!';
        return $this;
    }

    public function send(){
        try {
            return $this->mail->send();
        } catch (\Throwable $th) {
            return false;
        }
    }
}