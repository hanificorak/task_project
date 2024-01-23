<?php

use App\Http\Controllers\FactorController;
use App\Http\Controllers\HarshadNumberController;
use App\Http\Controllers\NumberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',function(){
    return view('home');
});

Route::get('/factors', [FactorController::class, 'index'])->name('factors');
Route::get('/numberForm', [NumberController::class,'numberForm'])->name("numberForm");
Route::post('/check-number', [NumberController::class, 'checkNumber'])->name('checkNumber');

Route::get('/checkHarshadForm', [NumberController::class,'checkHarshadForm'])->name("checkHarshadForm");
Route::post('/checkHarshadNumber', [HarshadNumberController::class, 'checkHarshadNumber'])->name('checkHarshadNumber');
