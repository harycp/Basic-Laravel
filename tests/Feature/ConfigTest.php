<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    public function testConfig()
    {
        $firstName = config('contoh.auhor.first');
        $lastName = config('contoh.auhor.last');
        $email = config('contoh.email');
        $web = config('contoh.web');

        var_dump($firstName, $lastName, $email, $web);

        self::assertEquals('Hary', $firstName);
        self::assertEquals('Capri', $lastName);
        self::assertEquals('omegahary88@gmail.com', $email);
        self::assertEquals('https://github.com/haryc', $web);
    }
}
