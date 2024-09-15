<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionTest extends TestCase
{
    public function testCreateSession()
    {
        $this->withHeader("X-API-KEY", "PZN")
        ->get("/session/create")
        ->assertSeeText("Session Created")
        ->assertSessionHas("idPerson", "AH22")
        ->assertSessionHas("isLogin", "true");
    }

    public function testGetSession()
    {
        $this->withHeader("X-API-KEY", "PZN")
        ->withSession(["idPerson" => "AH22", "isLogin" => "true"])
        ->get("/session/get")
        ->assertSeeText("AH22")->assertSeeText("true");
    }
}
