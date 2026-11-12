<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Middleware\LogArticleView;

Route::name('api.')->group(function () {
    // Публично
    Route::post('/register', [AuthController::class, 'registration'])->name('register');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login');

    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])
        ->name('articles.show')
        ->middleware(LogArticleView::class);

    // Только для авторизованных
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::apiResource('articles', ArticleController::class)
            ->except(['index', 'show']);
    });
});