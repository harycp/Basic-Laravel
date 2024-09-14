<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectTest extends TestCase
{
    public function testRedirect()
    {
        $this->get("redirect/from")
        ->assertRedirect("/redirect/to");
    }

    public function testRedirectRoute()
    {
        $this->get("redirect/name")
        ->assertRedirect("/redirect/name/Hary");
    }

    public function testRedirectAction()
    {
        $this->get("/redirect/action")
        ->assertRedirect("/redirect/name/Capri");
    }

    public function testRedirectAway()
    {
        $this->get("/redirect/away")
        ->assertRedirect("https://www.goodreads.com/");
    }
}
