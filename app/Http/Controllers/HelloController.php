<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    private HelloService $helloService;

    public function __construct(HelloService $helloService)
    {
        $this->helloService = $helloService;
    }
    public function hello($content)
    {
        return "Hello $content";
    }

    public function sayHello(string $content)
    {
        return $this->helloService->hello($content);
    }

    public function routes(Request $request)
    {
        return $request->path() . PHP_EOL . 
        $request->url() . PHP_EOL . 
        $request->fullUrl() . PHP_EOL . 
        $request->method() . PHP_EOL . 
        $request->header("Accept") . PHP_EOL;
    }
}
