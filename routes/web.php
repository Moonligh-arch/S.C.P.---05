<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('katalog.index');
});

// Placeholder route login untuk pengujian lokal sebelum modul Profil (Breeze) di-merge
Route::get('/login', function () {
    return 'Halaman Login (Disediakan oleh Modul Profil / Laravel Breeze)';
})->name('login');

// Route modul Katalog (file terpisah supaya konflik merge minimal)
require __DIR__.'/katalog.php';
