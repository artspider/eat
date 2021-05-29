<?php

// Home
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin'));
});

// Home > Blog
Breadcrumbs::for('admin', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Admin', route('admin'));
});

// Home > Blog > [Category]
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('admin');
    $trail->push('Users', route('admin-users'));    
});
