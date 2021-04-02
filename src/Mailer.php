<?php

namespace App;

class Mailer
{
    public function __construct(MailerInterface $mailer)
    {
        $mailer->send();
    }
}
