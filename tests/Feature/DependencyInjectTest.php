<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependencyInjectTest extends TestCase
{
    public function test()
    {
        $foo = new Foo();
        $bar = new Bar($foo);

        var_dump($bar->bar());

        self::assertEquals('foo and bar', $bar->bar());
    }
}
