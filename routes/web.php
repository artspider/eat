<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('eat-welcome');
})
->middleware('is_admin','auth:sanctum')
->name('admin');

/* Route::get('/admin', App\Http\Livewire\Admin\Dashboard::class)
->middleware('is_admin')
->name('admin-dashboard'); */

Route::prefix('admin')->group(function () {
    
    Route::get('/users', App\Http\Livewire\Admin\Users::class)
    ->middleware('is_admin','auth:sanctum')
    ->name('admin-users');    

    Route::group(['middleware' => ['role:superadmin|ceo|manager|chef','auth:sanctum']], function () {
        Route::get('/suppliers', App\Http\Livewire\Admin\Suppliers::class)
        ->name('admin-suppliers');

        Route::get('/suppliers/create', App\Http\Livewire\Admin\SupplierCreate::class)
        ->name('admin-suppliers-create');

        Route::get('/suppliers/edit/{supplier:company_name}', App\Http\Livewire\Admin\SupplierEdit::class)
        ->name('admin-suppliers-edit');

        Route::get('/products', App\Http\Livewire\Admin\Products::class)
        ->name('admin-products');

        Route::get('/products/create', App\Http\Livewire\Admin\ProductCreate::class)
        ->name('admin-products-create');

        Route::get('/products/edit/{product:slug}', App\Http\Livewire\Admin\ProductEdit::class)
        ->name('admin-products-edit');

        Route::get('/menus', App\Http\Livewire\Admin\Menus::class)
        ->name('admin-menus');

        Route::get('/menus/create', App\Http\Livewire\Admin\MenuCreate::class)
        ->name('admin-menus-create');

        Route::get('/menus/edit/{menu:slug}', App\Http\Livewire\Admin\MenuEdit::class)
        ->name('admin-menus-edit');

    });

    
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('eat-welcome2');
})->name('dashboard');

