<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


//CREATING ACCOUNT


Route::group(['middleware' => 'guest'], function(){
    //Account Registration
    Route::get('/register', [AuthController::class , 'register'])->name('register');
    //Creating Acc
    Route::post('/register', [AuthController::class , 'store']);


    //LOGGING IN ACCOUNT with Authenticate
    //Account LogIn
    Route::get('/login', [AuthController::class , 'login'])->name('login');
    //LogIn Authenticate
    Route::post('/login', [AuthController::class , 'authenticate']);
});

//LogOut
Route::post('/logout', [AuthController::class , 'logout'])->middleware('auth')->name('logout');
