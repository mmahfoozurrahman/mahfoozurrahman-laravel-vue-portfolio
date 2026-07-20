<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSiteSettingController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\AppLayoutController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes (Inertia.js Powered Portfolio)
|--------------------------------------------------------------------------
*/
Route::controller(AppLayoutController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/experience', 'experience')->name('experience');
    Route::get('/portfolio', 'portfolio')->name('portfolio');
    Route::get('/github', 'github')->name('github');
    Route::get('/contact', 'contact')->name('contact');
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Reusable Math Captcha Endpoint (addition/subtraction verification)
|--------------------------------------------------------------------------
| Generates a server-side challenge stored in the session. Any form
| (login, register, contact, etc.) can consume it via MathCaptcha.vue.
*/
Route::get('/captcha/math', [CaptchaController::class, 'generate'])->name('captcha.math');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (App\Http\Controllers\Admin Namespace)
|--------------------------------------------------------------------------
| (Authentication middleware can be wrapped here dynamically later)
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Protected Authenticating Routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    });

    // Authenticated Administrative Protected Routes
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Portfolio Projects CRUD
        Route::resource('projects', AdminProjectController::class)->except(['show']);
        
        // Timeline Experiences CRUD
        Route::resource('experiences', AdminExperienceController::class)->except(['show']);
        
        // Site-wide Settings Manager
        Route::get('settings', [AdminSiteSettingController::class, 'edit'])->name('settings.edit');
        Route::post('settings', [AdminSiteSettingController::class, 'update'])->name('settings.update');
        
        // Inquiries Inbox Manager
        Route::get('messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{message}', [AdminContactMessageController::class, 'show'])->name('messages.show');
        Route::post('messages/{message}/mark-read', [AdminContactMessageController::class, 'markRead'])->name('messages.mark-read');
        Route::post('messages/{message}/archive', [AdminContactMessageController::class, 'archive'])->name('messages.archive');
        Route::delete('messages/{message}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');
    });
});
