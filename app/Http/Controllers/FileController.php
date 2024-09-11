<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadFile(Request $request):string
    {
        $file = $request->file('picture');
        $name = $file->getClientOriginalName();
        $file->storePubliclyAs('pictures', $name, 'public');

        return "OK " . $file->getClientOriginalName();
    }
}
