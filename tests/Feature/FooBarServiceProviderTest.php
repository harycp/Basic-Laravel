<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FooBarServiceProviderTest extends TestCase 
{
    public function testServiceProvider()
    {
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo1, $foo2);
        self::assertSame($bar1, $bar2);
        self::assertSame($foo1, $bar1->foo);
    }

    public function testPropertySingletons()
    {
        $helloService1 = $this->app->make(HelloService::class);
        $helloService2 = $this->app->make(HelloService::class);

        self::assertSame($helloService1, $helloService2);
        self::assertEquals("Halo Hary", $helloService1->hello("Hary"));
        self::assertEquals("Halo Hary", $helloService2->hello("Hary"));
        self::assertEquals($helloService1->hello("Hary"), $helloService2->hello("Hary"));
    }

    public function test()
    {
        self::assertTrue(true);
    }

}
