<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testResponse()
    {
        $this->get('/response/hello')
        ->assertStatus(200)
        ->assertSeeText("Hello Response");
    }

    public function testHeaderResponse()
    {
        $this->get("/response/header")
        ->assertStatus(200)
        ->assertSeeText("Hary")->assertSeeText("Capri")
        ->assertHeader("Content-Type", "application/json")
        ->assertHeader("Author", "Hary Capri")
        ->assertHeader("App", "Laravel");
    }

    public function testViewResponse()
    {
        $this->get("/response/view")
        ->assertStatus(200)
        ->assertSeeText("Hello Hary");
    }

    public function testJsonResponse()
    {
        $this->get("/response/json")
        ->assertStatus(200)
        ->assertJson(["firstName" => "Hary", "lastName" => "Capri"]);
    }

    public function testFileResponse()
    {
        $this->get("/response/file")
        ->assertStatus(200)
        ->assertHeader("Content-Type", "image/jpeg");
    }

    public function testDownloadResponse()
    {
        $this->get("/response/download")
        ->assertStatus(200)
        ->assertDownload("testNewImage.jpg");
    }
}
