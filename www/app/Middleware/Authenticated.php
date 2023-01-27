<?php

namespace Simple\Mail\App\Middleware;

use Simple\Mail\App\Core\Router;

class Authenticated
{
    function before(): void
    {
        if ($_SESSION['auth'] == null) {
            Router::redirect('/login');
        }
    }
}