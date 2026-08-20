<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route baru untuk Halaman Menu
Route::get('/menu', function () {
    return view('menu');
});