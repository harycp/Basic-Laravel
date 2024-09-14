<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    public function testNotValid()
    {
        $this->get("/middleware/api")
        ->assertStatus(401)
        ->assertSeeText("Access Denied");
    }
    
    public function testValid()
    {
        $this->withHeader("X-API-KEY", "PZN")
        ->get("/middleware/api")
        ->assertStatus(200)
        ->assertSeeText("Access Success");
    }
    public function testGroupNotValid()
    {
        $this->get("/middleware/api/group1")
        ->assertStatus(401)
        ->assertSeeText("Access Denied");
    }
    
    public function testGroupValid()
    {
        $this->withHeader("X-API-KEY", "PZN")
        ->get("/middleware/api/group1")
        ->assertStatus(200)
        ->assertSeeText("Group 1");
    }

    public function testParameterValid()
    {
        $this->withHeader("X-API-KEY", "PZN")
        ->get("/middleware/api/parameter")
        ->assertStatus(200)
        ->assertSeeText("Parameter Success");
    }
}
