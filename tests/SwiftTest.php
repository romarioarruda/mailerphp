<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Swift;

class SwiftTest extends TestCase
{
    public function testObjectCanBeConstructed()
    {
        $this->assertInstanceOf(Swift::class, new Swift);
    }

    /**
    * @depends testObjectCanBeConstructed
    */
    public function testDispatchMail()
    {
        $this->expectOutputString('Email disparado.');

        try {
            $mailer = new Swift();
            $mailer->send();
            echo "Email disparado.";
        } catch (Exception $msg) {
            echo "Erro: falha no disparo do email.";
        }
    }
}