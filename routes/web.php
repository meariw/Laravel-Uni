<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

// Только для авторизованных
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('articles', ArticleController::class)
        ->except(['index', 'show']);

    Route::resource('articles.comments', CommentController::class)
        ->only(['store', 'edit', 'update', 'destroy'])
        ->shallow();
});

// Публично
Route::resource('articles', ArticleController::class)->only(['index', 'show']);

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/galery/{id}', [MainController::class, 'galery'])->name('galery');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', function () {
    $contacts = [
        'address'   => 'г. Минск, ул. Кофейная, д. 5',
        'phone'     => '+375 (29) 123-45-67',
        'email'     => 'hello@aestheticcafe.by',
        'worktime'  => 'Пн–Вс: 08:00 – 21:00',
        'instagram' => '@aesthetic.cafe',
    ];
    return view('contacts', ['contacts' => $contacts]);
})->name('contacts');

// Только для гостей
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'create'])->name('register');
    Route::post('/register', [AuthController::class, 'registration'])->name('register.post');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
});