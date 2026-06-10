<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;

use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tickets', TicketController::class);
});

// dashboard folder
// Route::get('/admin/tickets', [TicketController::class, 'admin.index'])
// ->name('admin.tickets.index');
// Route::get('/admin/users', [UserController::class, 'admin.index'])
// ->name('admin.users.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('tickets', AdminTicketController::class);
    Route::resource('users', AdminUserController::class);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'user'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->middleware('admin')->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
