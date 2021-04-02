<?php

namespace App;

use App\MailerInterface;

class Swift implements MailerInterface
{
    private $mailer;
    private $env;

    public function __construct()
    {
        $this->env = parse_ini_file('env.ini');

        $transport = new \Swift_SmtpTransport($this->env['smtp_service'], $this->env['smpt_port']);
        $transport->setEncryption($this->env['smpt_encryption']);
        $transport->setUsername($this->env['smtp_user']);
        $transport->setPassword($this->env['smtp_pass']);

        $this->mailer = new \Swift_Mailer($transport);
    }

    public function send()
    {
        $message = new \Swift_Message();
        $message->setSubject('Here is title');
        $message->setFrom([$this->env['smtp_user'] => 'John Doe']);
        $message->setTo(['romarioarruda98@gmail.com' => 'Romário Arruda']);
        $message->setBody('Here is the message itself');

        $this->mailer->send($message);
    }
}
