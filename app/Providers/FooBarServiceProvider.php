<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */

     public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
     ];
     
    public function register(): void
    {
        $this->app->singleton(Foo::class, function($app){
            return new Foo();
        });

        $this->app->singleton(Bar::class, function($app){
            return new Bar($app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function provides() : array
    {
        return [
            HelloService::class,
            Bar::class,
            Foo::class
        ];
    }
}
