<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admins.layout.app');
});

Route::get('/admin', function () {
    return view('admins.layout.app');
});

Route::get('/client', function () {
    return view('clients.layout.app');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
