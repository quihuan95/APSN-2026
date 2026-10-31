<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegistrationController::class, 'create'])->name('register');
Route::post('/dang-ky', [RegistrationController::class, 'store'])->name('register.store');
Route::get('/cam-on', [RegistrationController::class, 'thanks'])->name('register.thanks');

Route::get('/ho-chi-minh', [PageController::class, 'hoChiMinh'])->name('ho-chi-minh');
Route::get('/rex', [PageController::class, 'rex'])->name('rex');
Route::redirect('/trang-trong', '/khach-san-ve-tinh');
Route::get('/khach-san-ve-tinh', [PageController::class, 'satellite'])->name('satellite');
