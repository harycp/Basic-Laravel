<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectTo(): string
    {
        return "Ini halaman redirectnya";
    }

    public function redirectFrom(): RedirectResponse
    {
        return redirect("/redirect/to");
    }

    
    public function redirectRoute(Request $request): RedirectResponse
    {
        return redirect()
        ->route("redirect-name", [
            "name" => "Hary"
        ]);
    }


    public function redirectName(String $name): string
    {
        return "Hello $name";
    }

    public function redirectAction(): RedirectResponse
    {
        return redirect()
        ->action([RedirectController::class, "redirectName"], [
            "name" => "Capri"
        ]);
    }

    public function redirectAway(): RedirectResponse
    {
        return redirect()
        ->away("https://www.goodreads.com/");
    }
}
