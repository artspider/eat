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
    $trail->push('Edit Product '.$slug, route('admin-products-edit', $slug));
});
