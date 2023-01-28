<?php

use Simple\Mail\App\Controller\MailController;
use Simple\Mail\App\Core\Router;

Router::add('GET', '/api/mail', MailController::class, 'index');
Router::add('POST', '/api/mail', MailController::class, 'store');