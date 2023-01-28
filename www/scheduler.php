<?php

require_once 'vendor/autoload.php';
require_once 'config/config.php';

use Simple\Mail\App\Console\MailHandler;

MailHandler::run();