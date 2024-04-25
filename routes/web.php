<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/send-email', [HomeController::class, 'index'])->name('send-email');
Route::get('/admin.html', [HomeController::class, 'admin'])->name('admin');
Route::post('/admin.html', [HomeController::class, 'update'])->name('update');
Route::post('/update-password.html', [HomeController::class, 'update_password'])->name('update-password');
