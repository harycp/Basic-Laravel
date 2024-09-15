<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class URLTest extends TestCase
{
    public function testURLAll()
    {
        $this->get("/url/generate?name=Hary")
        ->assertSeeText("/url/generate?name=Hary");
    }
    public function testURLRedirect()
    {
        $this->get("/url/route")
        ->assertSeeText("/redirect/name/Yanuar");
    }
    public function testURLAction()
    {
        $this->get("/url/action")
        ->assertSeeText("/form");
    }
}
