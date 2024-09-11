<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get("/test", function(){
    return "Hello NOL!";
});

Route::redirect("/quizz", "/test");

Route::fallback(function(){
    return "Halaman Kosong, Sorry!";
});

Route::get("/hello", function(){
    return view("helo-test", ["name" => "Hary"]);
});

Route::get("/hello-world", function(){
    return view("hello.world", ["name" => "Hary"]);
});

// Route Parameter
Route::get("/hello/{name}", function($nameContent){
    return "Halo $nameContent";
});

Route::get("/hello/{name}/{say}", function($nameContent, $sayContent){
    return "Halo $nameContent, $sayContent";
});

Route::get("/Pages/{id}", function($pageId){
    return "Page $pageId";

})->where("id", "[0-9]+")->name('page.show'); // regex

Route::get("/Pages/{name}/id/{id}", function($name, $id){
    return "Page $name, $id";
})->name('page.show.details');

Route::get("/dashbord/{user?}", function(string $user = "Guest"){
    return "Dashbord $user";
})->where("user", "[A-Za-z]+");

// Conflict Route --> yang pertama dibuat yang akan dibaca oleh laravel

Route::get("/profile/{user}", function($user){
    return "Profile $user";
});

Route::get("/profile/hary", function(){
    return "Halo hary";
});

Route::get("/halaman/{id}", function($id){
    $link = route("page.show", [
        "id" => $id
    ]);
    return "Link : $link";
});
Route::get("/halaman-redirect/{name}/{id}", function($name, $id){
    return redirect()->route("page.show.details", [
        "id" => $id,
        "name" => $name
    ]);
});

// Menggunakan Controller
Route::get("/controller/{content}",[HelloController::class, "hello"]);

// Menggunakan Controller yang Dependancy Injection
Route::get("/controller/name/{content}", [HelloController::class, "sayHello"]);

Route::get("/controller/test/routes", [HelloController::class, "routes"]);

// Request Controller
Route::get("/request/hello", [RequestController::class, "request"]);
Route::post("/request/hello", [RequestController::class, "request"]);

// Nested Request Input
Route::post("/request/user", [RequestController::class, 'requestNested']);

// Mengambil semua input
Route::post("/request/input", [RequestController::class, 'requestInputAll']);

// Mengambil spesifik input
Route::post("/request/input/choose", [RequestController::class, 'requestInputChoose']);

// Input Type 
Route::post("/request/input/type", [RequestController::class, "inputType"]);

// Filter Only and Except
Route::post("/request/filter/only", [RequestController::class, "filterOnly"]);
Route::post("/request/filter/except", [RequestController::class, "filterExcept"]);

// File Upload
Route::post("/file/upload", [FileController::class, "uploadFile"]);

// Response
Route::get('/response/hello', [ResponseController::class, 'response']);
Route::get("/response/header", [ResponseController::class, 'headerResponse']);
Route::get("/response/view", [ResponseController::class, 'viewResponse']);
Route::get("/response/json", [ResponseController::class, 'jsonResponse']);
Route::get("/response/file", [ResponseController::class, 'fileResponse']);
Route::get("/response/download", [ResponseController::class, 'downloadResponse']);
