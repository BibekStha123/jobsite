<?php

use App\Http\Controllers\admin\AdminController;
use App\Models\Listing;

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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

// Users
Route::post('/users', [UserController::class, 'createUser']);
Route::post('/users/login', [UserController::class, 'authenticateUser']);
Route::post('/logout', [UserController::class, 'logout']);
// guest
Route::middleware('guest')->group(function() {
    Route::get('/register', [UserController::class, 'register']);
    Route::get('/login', [UserController::class, 'login'])->name('login');
});

// Listings 
Route::get('/', [ListingController::class, 'index']);
Route::middleware('auth')->controller(ListingController::class)->prefix('/listing')->group(function () {
    Route::get('/create', 'create');
    Route::post('',  'store');
    Route::get('/{listing}/edit', 'edit');
    Route::put('/{listing}', 'update');
    Route::delete('/{listing}', 'delete');
    Route::get('/manage', 'manage');
});
Route::get('/listing/{listing}', [ListingController::class, 'show']);

// admin routes
Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/authenticate', [AdminController::class, 'authenticate']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
