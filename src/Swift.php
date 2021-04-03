<?php

namespace App;

use App\MailerInterface;

class Swift implements MailerInterface
{
    private $mailer;
    private $env;
    private $data;

    public function __construct(array ...$data)
    {
        $this->env = parse_ini_file('env.ini');

        $this->data = $data[0];

        $transport = new \Swift_SmtpTransport($this->env['smtp_service'], $this->env['smpt_port']);
        $transport->setEncryption($this->env['smpt_encryption']);
        $transport->setUsername($this->env['smtp_user']);
        $transport->setPassword($this->env['smtp_pass']);

        $this->mailer = new \Swift_Mailer($transport);
    }

    public function send()
    {
        [$mail, $name, $title, $text] = $this->data;

        $message = new \Swift_Message();
        $message->setSubject($title);
        $message->setFrom([$this->env['smtp_user'] => 'John Doe']);
        $message->setTo([$mail => $name]);
        $message->setBody($text);

        $this->mailer->send($message);
    }
}
