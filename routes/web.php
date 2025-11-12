<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ResetTokenController;
use App\Http\Controllers\ProductController;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

Route::view('/',"home")->name("home");
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
// Route::get("*",[AuthController::class,'error'])->name("errorPage");//not working

Route::middleware('guest')->controller(AuthController::class)->group(function(){
    Route::get('/signup','showSignup')->name('signup');
    Route::post('/signup','signup')->name('signup.post');
    Route::get('/login','showLogin')->name('login');
    Route::post('/login','login')->name('login.post');
    
});

Route::middleware('guest')->controller(ResetTokenController::class)->group(function(){
    Route::get("/forget-password","getForget")->name("viewForget");
    Route::post("/forget-password","postForget")->name("forget");
    Route::get("/reset/{token}","getReset")->name("password.reset");
    Route::post("/reset","postReset")->name("password.update");
});

Route::controller(EmployeeController::class)->middleware('auth')->group(function(){
    Route::get("/viewEmployee",'viewEmployee')->name('view');
    Route::get("/addEmployee",'addEmployee')->name('add');
    Route::post("/addEmployee","postEmployee")->name('add.post');
    Route::get("/editEmployee/{id}",'editEmployee')->name('edit');
    Route::put("/editEmployee/{id}","postEdit")->name('edit.post');
    Route::get("/viewEmployee/{id}","delEmployee")->name("delete");
    Route::get("/viewProfile/{id}","viewProfile")->name("getProfile");
    Route::get("/updateProfile/{id}","profile")->name('profile');
    Route::put("/updateProfile/{id}","updateProfile")->name("updateProfile.post");

});

Route::middleware("auth")->resource('products', ProductController::class);

Route::controller(DataController::class)->middleware("auth")->group(function(){
    Route::get("/data","view")->name("data");
    Route::put("/update","update")->name("update");
    Route::post("/data-delete","store_delete")->name("data_delete");
});
