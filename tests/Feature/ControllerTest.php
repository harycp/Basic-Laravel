<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    public function testController()
    {
        $this->get("/controller/Hary")
        ->assertSeeText("Hello Hary");
    }

    public function testControllerServices()
    {
        $this->get("/controller/name/Ucup")
        ->assertSeeText("Halo Ucup");
    }

    public function testControllerRoutes()
    {
        $this->get("/controller/test/routes", [
            "Accept" => "plain/text"
        ])->assertSeeText("controller/test/routes")
        ->assertSeeText("http://localhost/controller/test/routes")
        ->assertSeeText("GET")
        ->assertSeeText("plain/text");
    }
}
