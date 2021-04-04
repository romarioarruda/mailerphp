<?php

namespace App;

use App\MailerInterface;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PHPMail implements MailerInterface
{
    private $mailer;
    private $env;
    private $data;

    public function __construct(array ...$data)
    {
        $this->env = parse_ini_file('env.ini');

        $this->data = $data[0];

        $this->mailer = new PHPMailer(true);

        // $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mailer->isSMTP();
        $this->mailer->Host       = $this->env['smtp_service'];
        $this->mailer->SMTPAuth   = true;
        $this->mailer->Username   = $this->env['smtp_user'];
        $this->mailer->Password   = $this->env['smtp_pass'];
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port       = $this->env['smpt_port_phpmailer'];
    }

    public function send()
    {
        [$mail, $name, $title, $text] = $this->data;

        $this->mailer->setFrom($this->env['smtp_user'], utf8_decode('Romário Rodrigues'));
        $this->mailer->addAddress($mail, utf8_decode($name));

        $this->mailer->isHTML(true);
        $this->mailer->Subject = $title;
        $this->mailer->Body    = $text;
        $this->mailer->send();
    }
}
