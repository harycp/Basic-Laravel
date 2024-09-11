<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return response('Hello Response');
    }

    public function headerResponse(Request $request): Response
    {
        $body = [
            "firstName" => "Hary",
            "lastName" => "Capri"
        ];

        return response(json_encode($body), 200)
        ->header("Content-Type", "application/json")
        ->withHeaders([
            "Author" => "Hary Capri",
            "App" => "Laravel"
        ]);
    }

    public function viewResponse(Request $request): Response
    {
        return response()
        ->view("helo-test", ["name" => "Hary"]);
    }

    public function jsonResponse(Request $request): JsonResponse
    {
        $body = [
            "firstName" => "Hary",
            "lastName" => "Capri"
        ];

        return response()->json($body);
    }

    public function fileResponse(Request $request):BinaryFileResponse
    {
        return response()
        ->file(public_path("./storage/pictures/testImage.jpg"));
    }

    public function downloadResponse(Request $request):BinaryFileResponse
    {
        return response()
        ->download(public_path("./storage/pictures/testImage.jpg"), "testNewImage.jpg");
    }
}