<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use Tests\TestCase;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotSame;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceContainerTest extends TestCase
{
    public function testDependencyInject()
    {
        // $foo = new Foo();
        // make --> membuat instance baru
        $foo1 = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);
        
        var_dump($foo1->foo() . ' and ' . $foo2->foo());

        self::assertEquals('foo', $foo1->foo());
        self::assertEquals('foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {

        // bila ada constructor di class nya
        // $person = new Person("Hary", "Capri");

        // bind --> membuat agar instance baru bisa dipanggil dengan parameter dari construct

        // bind akan dibuat terus menerus
        $first = "Hary";
        $last = "Capri";
        $this->app->bind(Person::class, function($app) use ($first, $last) {
            return new Person($first, $last);
        });

        $person1 = $this->app->make(Person::class); // new Person("Hary", "Capri")
        $person2 = $this->app->make(Person::class); // new Person("Hary", "Capri")

        var_dump($person1->firstName . ' and ' . $person1->lastName);
        var_dump($person2->firstName . ' and ' . $person2->lastName);

        self::assertEquals($first, $person1->firstName);
        self::assertEquals($first, $person2->firstName);
        self::assertNotSame($person1, $person2);
    }

    public function testSingleton()
    {
        // singleton hanya akan membuat instance satu kali

        $first = "Hary";
        $last = "Capri";
        $this->app->singleton(Person::class, function($app) use ($first, $last) {
            return new Person($first, $last);
        });

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        var_dump($person1->firstName . ' and ' . $person1->lastName); // new Person("Hary", "Capri")
        var_dump($person2->firstName . ' and ' . $person2->lastName); // mengulang yg sudah ada

        self::assertEquals($first, $person1->firstName);
        self::assertEquals($first, $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        // Membuat instance dengan object yang sudah ada

        $person = new Person("Hary", "Capri");
        $this->app->instance(Person::class,$person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        var_dump($person1->firstName . ' and ' . $person1->lastName); // new Person("Hary", "Capri")
        var_dump($person2->firstName . ' and ' . $person2->lastName); // mengulang yg sudah ada

        self::assertEquals("Hary", $person1->firstName);
        self::assertEquals("Hary", $person2->firstName);
        self::assertSame($person1, $person2);
    }

    public function testDependencyInjection()
    {   
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });

        // menggunakan app sebagai service containernya
        $this->app->singleton(Bar::class, function($app){
            return new Bar($app->make(Foo::class));
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        // self::assertNotSame($foo, $bar->foo);
        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
        // self::assertNotSame($bar1, $bar2);

    }

    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);
        $this->app->singleton(HelloService::class, function($app){
            return new HelloServiceIndonesia(); // bisa menggunakan closure juga
        });


        $hello = $this->app->make(HelloService::class);

        self::assertEquals("Halo Hary", $hello->hello("Hary"));
    }
}
