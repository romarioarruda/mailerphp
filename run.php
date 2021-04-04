<?php
require_once __DIR__ . "/vendor/autoload.php";

use App\Mailer;
use App\Swift;
use App\PHPMail;

new Mailer(new PHPMail([
    'romarioarruda98@gmail.com',
    'Romário Arruda',
    'Titulo de teste',
    'Esse conteúdo permite HTML <b>exemplo!</b>'
]));
