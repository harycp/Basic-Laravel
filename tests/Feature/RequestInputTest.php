<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RequestInputTest extends TestCase
{
    public function testRequestInput()
    {
        $this->get("/request/hello?name=hary")->assertSeeText("Hello hary");
        $this->post("/request/hello", ["name" => "Hary"])->assertSeeText("Hello Hary");
    }

    public function testRequestNestedInput()
    {
        $this->post('/request/user', [
            "name" => [
                "firstName" => "Depan",
                "lastName" => "Belakang"
            ]
            ])->assertSeeText("Hello Depan");
    }

    public function testInputType()
    {
        $this->post('/request/input/type', [
            "name" => "Hary",
            "married" => true,
            "birth_date" => "2005-01-01"
        ])->assertSeeText("Hary")->assertSeeText("true")->assertSeeText("2005-01-01");
    }

    public function testFilterOnly()
    {
        $this->post('/request/filter/only', [
            "name" => "Hary",
            "age" => 20,
            "address" => "jl.sukajaya No.11"
        ])->assertSeeText("Hary")->assertSeeText("20")->assertDontSeeText('address');
    }

    public function testFilterExcept()
    {
        $this->post('/request/filter/except', [
            "name" => "Hary",
            "age" => 20,
            "address" => "jl.sukajaya No.11"
        ])->assertSeeText("jl.sukajaya No.11")->assertDontSeeText("Hary")->assertDontSeeText("20");
    }

    
}
