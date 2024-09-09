<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function request(Request $request): string
    {
        $name = $request->input("name");
        return "Hello $name";
    }

    public function requestNested(Request $request): string
    {
        $name = $request->input("name.firstName");

        return "Hello $name";
    }

    public function requestInputAll(Request $request): string
    {
        $data = $request->input();

        return json_encode($data);
    }

    public function requestInputChoose(Request $request): string
    {
        $data = $request->input("address.*.city");
        return json_encode($data);
    }

    public function inputType(Request $request): string
    {
        $name = $request->input("name");
        $married = $request->boolean("married", false);
        $birthDate = $request->date("birth_date", "Y-m-d");
        
        return json_encode([
            "name" => $name,
            "married" => $married,
            "birth_date" => $birthDate->format("Y-m-d")
        ]);
    }

    public function filterOnly(Request $request): string
    {
        $data = $request->only(['name', 'age']);
        return json_encode($data);
    }

    public function filterExcept(Request $request): string
    {
        $data = $request->except(['name', 'age']);

        return json_encode($data);
    }
}
