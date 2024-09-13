<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CookieTest extends TestCase
{
    public function testCreateCookie()
    {
        $this->get("/cookie/create")
        ->assertCookie("name", "Hary")
        ->assertCookie("isLogin", true);
    }

    public function testGetCookie()
    {
        $this->withCookie("name", "Hary")->withCookie("isLogin", true)
        ->get("/cookie/get")
        ->assertJson([
            "name" => "Hary",
            "isLogin" => true
        ]);
    }

    public function testClearCookie()
    {
        $this->get("/cookie/clear")
        ->assertCookie("name", "")
        ->assertCookie("isLogin", "");
    }

}

