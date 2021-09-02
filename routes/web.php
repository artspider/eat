<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DishController;
use App\Http\Controllers\KitchenController;

Route::get('/', function () {
    return view('landing-page');
});

Route::get('/admin', function () {
    return view('eat-welcome');
})
->middleware('is_admin','auth:sanctum')
->name('admin');

Route::get('/promo/morning/edit', function () {
    return view('promomorning');
})
->middleware('is_admin','auth:sanctum')
->name('admin');

Route::get('/promo/dinner/edit', function () {
    return view('promodinner');
})
->middleware('is_admin','auth:sanctum')
->name('admin');

Route::get('/promo/dailypromo/edit', function () {
    return view('dailypromo');
})
->middleware('is_admin','auth:sanctum')
->name('admin');


/* Route::get('/admin', App\Http\Livewire\Admin\Dashboard::class)
->middleware('is_admin')
->name('admin-dashboard'); */
Route::get('/orders', App\Http\Livewire\Orders::class)
    ->middleware('auth:sanctum')
    ->name('orders');

Route::get('/cashregister', App\Http\Livewire\Cashregister::class)
    ->middleware('auth:sanctum')
    ->name('cashregister');

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

        Route::get('/recipes', App\Http\Livewire\Admin\Recipes::class)
        ->name('admin-recipes');

        Route::get('/recipes/create', App\Http\Livewire\Admin\RecipeCreate::class)
        ->name('admin-recipes-create');

        Route::get('/recipes/edit/{recipe:slug}', App\Http\Livewire\Admin\RecipeEdit::class)
        ->name('admin-recipes-edit');

        /* Route::get('/dishes', App\Http\Livewire\Admin\Dishes::class)
        ->name('admin-dishes'); */

        Route::get('/dishes', [DishController::class, 'index'])
        ->name('admin-dishes');

        Route::get('/dishes/create',App\Http\Livewire\Admin\DishCreate::class)
        ->name('admin-dishes-create');

        Route::get('/dishes/edit/{dish:slug}',App\Http\Livewire\Admin\DishEdit::class)
        ->name('admin-dishes-edit');

        Route::get('/kitchen', [KitchenController::class, 'index'])
        ->name('admin-kitchen');
    });

    
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('eat-welcome2');
})->name('dashboard');