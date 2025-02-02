<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DeployController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/custom-register', [CustomAuthController::class, 'register'])->name('custom-register');
Route::post('/custom-login', [CustomAuthController::class, 'login'])->name('custom-login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/deploy-boutique', [DeployController::class, 'store'])->name('deploy.store');
});


Route::domain('{subdomain}.eventchills.com')->group(function () {
    Route::get('/', [DeployController::class, 'show'])->name('deploy.show');
});
