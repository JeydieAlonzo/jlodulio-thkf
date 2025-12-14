<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionController; 
use App\Http\Controllers\ReservationController;

Route::view('/', 'welcome');

// Dashboard
Route::get('/dashboard', [SectionController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// -----------------------------------------------------
// RESERVATION ROUTES
// -----------------------------------------------------

// 1. Custom 'Cancel' Route (Must be BEFORE resource)
Route::patch('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])
    ->name('reservations.cancel');

// 2. Standard Resource Routes (Index, Create, Store, Show, Edit, Update, Destroy)
Route::resource('reservations', ReservationController::class)
    ->middleware(['auth']);

// 3. Sections Index (Manual)
Route::get('/sections', [SectionController::class, 'index'])
    ->name('sections.index');

require __DIR__.'/auth.php';