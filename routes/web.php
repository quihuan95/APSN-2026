<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\EnsureAdminAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegistrationController::class, 'create'])->name('register');
Route::post('/dang-ky', [RegistrationController::class, 'store'])->name('register.store');
Route::get('/registration', [RegistrationController::class, 'createInvited'])->name('register.invited');
Route::post('/registration', [RegistrationController::class, 'storeInvited'])->name('register.invited.store');
Route::redirect('/dang-ky-khach-moi', '/registration?invited');
Route::get('/cam-on', [RegistrationController::class, 'thanks'])->name('register.thanks');

Route::get('/ho-chi-minh', [PageController::class, 'hoChiMinh'])->name('ho-chi-minh');
Route::get('/rex', [PageController::class, 'rex'])->name('rex');
Route::redirect('/trang-trong', '/khach-san-ve-tinh');
Route::get('/khach-san-ve-tinh', [PageController::class, 'satellite'])->name('satellite');

// Admin Authentication
Route::redirect('/admin', '/admin/registrations');
Route::get('/admin/login', [AdminAuthController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'store'])->name('admin.login.store');
Route::post('/admin/logout', [AdminAuthController::class, 'destroy'])->name('admin.logout');

// Admin Protected Area
Route::prefix('admin')->name('admin.')->middleware(EnsureAdminAuthenticated::class)->group(function (): void {
    Route::get('/registrations/export', [AdminRegistrationController::class, 'export'])->name('registrations.export');
    Route::delete('/registrations/bulk', [AdminRegistrationController::class, 'bulkDestroy'])->name('registrations.bulk-destroy');
    Route::get('/registrations/{registration}/passport', [AdminRegistrationController::class, 'passport'])->name('registrations.passport');
    Route::resource('registrations', AdminRegistrationController::class)->only(['index', 'show', 'destroy']);
});
