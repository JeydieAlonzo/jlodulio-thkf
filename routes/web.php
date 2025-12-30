<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SectionController; 
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ScheduleController;

Route::view('/', 'welcome');

// Dashboard
Route::get('/dashboard', function () {
    $user = auth()->user();

    // 1. If Admin (ID 3) -> Show the Admin Panel View
    if ($user->usertype_id == 3) {
        return view('dashboard'); // Shows the view directly (No Redirect Loop)
    }

    // 2. If Student (1) or Librarian (2) -> Redirect to Section List
    return redirect()->route('sections.index');
    
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// -----------------------------------------------------
// RESERVATION ROUTES
// -----------------------------------------------------

// Made when needed to cancel a reservation
Route::patch('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])
    ->name('reservations.cancel');

// Standard Resource Routes (Index, Create, Store, Show, Edit, Update, Destroy)
Route::resource('reservations', ReservationController::class)
    ->middleware(['auth']);

// Made because I need to catch the section_id filter
Route::get('/sections', [SectionController::class, 'index'])
    ->name('sections.index');

// ADMIN ROUTES GROUP
Route::middleware(['auth', 'usertype:3'])->prefix('admin')->group(function () {
    // This creates /admin/dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // You can put your future CRUD routes here too
    // Route::resource('usertypes', UserTypeController::class);
});


// SECTION ROUTES (Accessible by everyone, or limit via middleware)
Route::resource('sections', SectionController::class)->middleware(['auth']);

// user type routes
Route::resource('usertypes', UserTypeController::class)->middleware(['auth']);

Route::resource('users', UserController::class)->middleware(['auth']);

Route::resource('resources', ResourceController::class)->middleware(['auth']);

Route::resource('schedules', ScheduleController::class)->middleware(['auth']);

require __DIR__.'/auth.php';