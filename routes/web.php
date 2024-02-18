<?php

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

// Listings 
Route::get('/', [ListingController::class, 'index']);
Route::get('/listing/create', [ListingController::class, 'create']);
Route::post('/listing', [ListingController::class, 'store']);
Route::get('/listing/{listing}/edit', [ListingController::class, 'edit']);
Route::put('/listing/{listing}', [ListingController::class, 'update']);
Route::delete('/listing/{listing}', [ListingController::class, 'delete']);
Route::get('/listing/{listing}', [ListingController::class, 'show']);
// Users
Route::get('/register', [UserController::class, 'register']);
Route::post('/users', [UserController::class, 'createUser']);
Route::post('/logout', [UserController::class, 'logout']);
