<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('eat-welcome');
});


Route::get('/admin', App\Http\Livewire\Admin\Dashboard::class)
->middleware('is_admin')
->name('admin-dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

