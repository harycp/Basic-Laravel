<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request)
    {
        $request->session()->put("idPerson", "AH22");
        $request->session()->put("isLogin", "true");

        return "Session Created ";
    }

    public function getSession(Request $request)
    {
        $idPerson = $request->session()->get("idPerson");
        $isLogin = $request->session()->get("isLogin");

        return "Id Person : $idPerson, Is Login : $isLogin";
    }
}
