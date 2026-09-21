<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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