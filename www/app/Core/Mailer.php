<?php
namespace Simple\Mail\App\Core;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer{
    protected $mail;
    protected $view;

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

    public function body($data, $view=null){
        $this->mail->isHTML(true);
        $viewPath   = __DIR__ . '/../View/mail/'.$view.'.php';
    
        ob_start();
        require(__DIR__ . '/../View/template/header.php');
        if ($view && file_exists($viewPath)) {
            require($view);
        }elseif(is_string($data)){
            echo $data;
        }
        require(__DIR__ . '/../View/template/footer.php');

        $this->mail->Body = ob_get_contents();

        ob_end_clean();

        return $this;
    }

    public function view($view, $data){
        $output = "";


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