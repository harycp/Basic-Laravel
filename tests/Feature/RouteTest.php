<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    public function testRoute()
    {
        $this->get("/test")
        ->assertStatus(200)
        ->assertSeeText("Hello NOL!");
    }

    public function testRedirect()
    {
        $this->get("/quizz")
        ->assertRedirect("/test");
    }

    // php artisan route:list --> melihat semua route

    public function testFallback()
    {
        $this->get("/404")
        ->assertSeeText("Halaman Kosong, Sorry!");
    }
    
    public function testRouteParameter()
    {
        $this->get("/hello/Broski")
        ->assertSeeText("Halo Broski");

        $this->get("/hello/Harry/GoodMorning")
        ->assertSeeText("Halo Harry, GoodMorning");
    }
    public function testParameterRegex()
    {
        $this->get("/Pages/900")
        ->assertSeeText("Page 900");

        $this->get("/Pages/hai")
        ->assertSeeText("Halaman Kosong, Sorry!");
    }

    public function testParameterOptional()
    {
        $this->get("/dashbord/Hary")
        ->assertSeeText("Dashbord Hary");

        $this->get("/dashbord/")
        ->assertSeeText("Dashbord Guest");
    }

    public function testParameterConflict()
    {
        // $this->get("/profile/hary")
        // ->assertSeeText("Halo hary"); --> akan error

        $this->get("/profile/Hary")
        ->assertSeeText("Profile Hary");
    }

    public function testNameRoute()
    {
        $this->get("/halaman/900")
        ->assertSeeText("Link : http://localhost/Pages/900");

        $this->get("/halaman-redirect/Hary/900")
        ->assertRedirect("/Pages/Hary/id/900");
    }

}
