<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FormCsrfController extends Controller
{
    public function formview():Response
    {
        return response()->view("form");
    }

    public function forminput(Request $request):Response
    {
        $token1 = $request->session()->token();
        $token2 = csrf_token();

        $value = $request->input("name");
        return response()
        ->view('helo-test', [
            "name" => $value,
            "token_1" => $token1,
            "token_2" => $token2
        ]);
    }

    public function getCsrf(Request $request): Response
    {
        $token = $request->session()->token();

        $token1 = csrf_token();

        return response("$token, $token1");
    }

}

