<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\TrustedByController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login',   [AuthController::class, 'showLogin'])->name('login');
    Route::post('login',  [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Forgot Password
    Route::get('forgot-password',  [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Reset Password
    Route::get('reset-password/{token}',  [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password',         [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::middleware('admin')->group(function () {

        Route::get('/',  [DashboardController::class, 'index'])->name('dashboard');

        // Hero
        Route::get('hero', [HeroController::class, 'edit'])->name('hero.edit');
        Route::put('hero', [HeroController::class, 'update'])->name('hero.update');

        // About
        Route::get('about', [AboutController::class, 'edit'])->name('about.edit');
        Route::put('about', [AboutController::class, 'update'])->name('about.update');

        // Services
        Route::resource('services', ServiceController::class)->except(['show']);

        // Team (route model binding key = 'team')
        Route::resource('team', TeamController::class)->except(['show']);

        // Partnerships (formerly Clients)
        Route::resource('clients', ClientController::class)->except(['show']);

        // Trusted By
        Route::resource('trusted-by', TrustedByController::class)->except(['show'])
            ->parameters(['trusted-by' => 'trustedBy']);

        // Messages
        Route::get('messages',              [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}',    [MessageController::class, 'show'])->name('messages.show');
        Route::delete('messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

        // Settings
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
