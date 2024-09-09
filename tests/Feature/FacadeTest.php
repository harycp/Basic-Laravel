<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstName1 = Config("contoh.auhor.first");
        $firstName2 = Config::get("contoh.auhor.first"); // menggunakan facade


        self::assertEquals($firstName1, $firstName2);
        var_dump(Config::all());
    }
    public function testConfigDependency()
    {

        $config = $this->app->make("config");

        $firstName3 = $config->get("contoh.auhor.first");

        $firstName1 = Config("contoh.auhor.first");
        $firstName2 = Config::get("contoh.auhor.first"); // menggunakan facade


        self::assertEquals($firstName1, $firstName2);
        self::assertEquals($firstName1, $firstName3);
        var_dump(Config::all());
    }

    public function testFacadeMock(){

        //mockery

        Config::shouldReceive("get")
        ->with("contoh.author.first")
        ->andReturn("Hary Mantap");

        $firstName = Config::get("contoh.author.first");

        self::assertEquals("Hary Mantap", $firstName);
    }
}
