<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('eat-welcome');
})
->middleware('is_admin')
->name('admin');

/* Route::get('/admin', App\Http\Livewire\Admin\Dashboard::class)
->middleware('is_admin')
->name('admin-dashboard'); */

Route::get('/admin/users', App\Http\Livewire\Admin\Users::class)
->middleware('is_admin')
->name('admin-users');

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); */

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('eat-welcome');
})->name('dashboard');
