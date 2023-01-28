<?php

namespace Simple\Mail\App\Middleware;

use Simple\Mail\App\Core\Router;
use Simple\Mail\App\Core\Token;

class Authenticated
{
    function before(): void
    {
        Token::verify();
    }
}