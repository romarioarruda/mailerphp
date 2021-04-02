<?php
require_once __DIR__ . "/vendor/autoload.php";

use App\Mailer;
use App\Swift;
use App\PHPMailer;

$mailer = new Mailer(new Swift());
