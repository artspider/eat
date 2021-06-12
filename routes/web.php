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

Route::prefix('admin')->group(function () {
    Route::get('/users', App\Http\Livewire\Admin\Users::class)
    ->middleware('is_admin')
    ->name('admin-users');

    Route::group(['middleware' => ['role:superadmin|ceo|manager|chef']], function () {
        Route::get('/products', App\Http\Livewire\Admin\Products::class)
        ->name('admin-products');

        Route::get('/products/create', App\Http\Livewire\Admin\ProductCreate::class)
        ->name('admin-products-create');

        Route::get('/products/edit/{product:slug}', App\Http\Livewire\Admin\ProductEdit::class)
        ->name('admin-products-edit');
    });

    /* Route::group(['middleware' => ['role:superadmin|ceo|manager|chef']], function () {
        Route::get('/products/create', App\Http\Livewire\Admin\ProductCreate::class)
        ->name('admin-products-create');
    }); */
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('eat-welcome');
})->name('dashboard');

