<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    public function testView()
    {
        $this->get("/hello")
        ->assertSeeText("Hello Hary");
    }

    public function testNestedView()
    {
        $this->get("/hello-world")
        ->assertSeeText("Hello Hary");
    }

    // Compiling View
    // php artisan view:cache
    // php artisan view:clear

    public function testTemplate()
    {
        // bisa langsung test tanpa routing terlebih dahulu
        $this->view("helo-test", ["name" => "Hary"])
        ->assertSeeText("Hello Hary");
    }
}
