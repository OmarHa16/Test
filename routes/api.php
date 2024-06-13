<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthControllers;
use App\Models\Article;

Route::post('/register', [AuthControllers::class, "register"]);
Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::post('/login', [AuthControllers::class, "login"]);
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/search', [ArticleController::class, 'search']);
});



