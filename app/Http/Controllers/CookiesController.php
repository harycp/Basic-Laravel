<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookiesController extends Controller
{
    public function createCookie(Request $request): Response
    {
        return response("Create Cookie")
        ->cookie("name", "Hary", 1000, "/")
        ->cookie("isLogin", true, 1000, "/");
    }

    public function getCookie(Request $request): JsonResponse
    {
        return response()
        ->json([
            "name" => $request->cookie("name", "Guest"),
            "isLogin" => $request->cookie("isLogin", false)
        ]);
    }

    public function clearCookie(Request $request): Response
    {
        return response("Clear Cookie")
        ->withoutCookie("name")
        ->withoutCookie("isLogin");
    }
}
