<?php

namespace App;

class PHPMailer implements MailerInterface
{
    public function __construct()
    {
       // code here
    }

    public function send()
    {
        echo "PHPMailer:: Enviando email..\n";
    }
}
