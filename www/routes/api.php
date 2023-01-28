<?php

use Simple\Mail\App\Controller\MailController;
use Simple\Mail\App\Controller\TokenController;
use Simple\Mail\App\Core\Router;
use Simple\Mail\App\Middleware\Authenticated;

Router::add('POST', '/api/token', TokenController::class, 'generate');
Router::add('GET', '/api/mail', MailController::class, 'index',[Authenticated::class]);
Router::add('POST', '/api/mail', MailController::class, 'store',[Authenticated::class]);