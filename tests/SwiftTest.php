<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Swift;

class SwiftTest extends TestCase
{
    public function testObjectCanBeConstructed()
    {
        $this->assertInstanceOf(Swift::class, new Swift());
    }

    public function testParseIniFiles()
    {
        $env = parse_ini_file('env.ini');

        $status = array_filter($env, function ($item) {
            return empty($item);
        });

        $this->assertEmpty($status);
    }

    /**
    * @depends testObjectCanBeConstructed
    */
    public function testDispatchMail()
    {
        $this->expectOutputString('Email disparado.');

        try {
            $mailer = new Swift([
                'romarioarruda98@gmail.com',
                'Romário',
                'Titulo de teste',
                'Texto do email para teste'
            ]);
            $mailer->send();
            echo "Email disparado.";
        } catch (Exception $msg) {
            echo "Erro: falha no disparo do email.";
        }
    }
}
