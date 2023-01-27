<?php

use Simple\Mail\App\Controller\MailController;
use Simple\Mail\App\Core\Router;

Router::add('GET', '/', MailController::class, 'index');