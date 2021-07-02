<?php

// Home
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin'));
});

Breadcrumbs::for('admin', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Admin', route('admin'));
});

Breadcrumbs::for('users', function ($trail) {
    $trail->parent('admin');
    $trail->push('Users', route('admin-users'));    
});

Breadcrumbs::for('products', function ($trail) {
    $trail->parent('admin');
    $trail->push('Products', route('admin-products'));    
});

Breadcrumbs::for('products-create', function ($trail) {
    
    $trail->parent('products');
    $trail->push('Add Product', route('admin-products-create'));    
});

Breadcrumbs::for('products-edit', function ($trail,$slug) {
    
    $trail->parent('products');
    $trail->push('Edit Product: '.$slug, route('admin-products-edit', $slug));
});

Breadcrumbs::for('suppliers', function ($trail) {
    $trail->parent('admin');
    $trail->push('Suppliers', route('admin-suppliers'));    
});

Breadcrumbs::for('suppliers-create', function ($trail) {
    
    $trail->parent('suppliers');
    $trail->push('Add Supplier', route('admin-suppliers-create'));    
});

Breadcrumbs::for('suppliers-edit', function ($trail,$company_name) {
    
    $trail->parent('suppliers');
    $trail->push('Edit Supplier: '.$company_name, route('admin-suppliers-edit', $company_name));    
});

Breadcrumbs::for('menus', function ($trail) {
    $trail->parent('admin');
    $trail->push('Recetas', route('admin-menus'));    
});

Breadcrumbs::for('menus-create', function ($trail) {
    
    $trail->parent('menus');
    $trail->push('Add Recipe', route('admin-menus-create'));    
});