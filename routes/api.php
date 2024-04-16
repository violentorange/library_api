<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('categories', [CategoryController::class, 'index']);
Route::apiResource('categories', CategoryController::class);
Route::get('categories/{category}/books', [CategoryController::class, 'showBooks']);

Route::apiResource('books', BookController::class);
Route::get('books/{book}/authors', [BookController::class,'showAuthors']);

Route::apiResource('authors', AuthorController::class);
Route::get('authors/{author}/books', [AuthorController::class,'showBooks']);

Route::get('countries/{country}/authors', [CountryController::class,'showAuthors']);