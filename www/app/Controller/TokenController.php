<?php

namespace Simple\Mail\App\Controller;

use Simple\Mail\App\Core\Controller;
use Simple\Mail\App\Core\Token;

class TokenController extends Controller
{

  public function generate()
  {
    $config = config('jwt');

    if($this->input('client_id')!=$config['client_id'] || 
    $this->input('password')!=$config['client_secret']){
      $this->response([
        'status' =>'FAIL',
        'message'=>'Invalid client id or password'
      ]);
    }

    $this->response([
      'status'=>'OK',
      'token'=>Token::generete()
    ]);
  }
}