<?php

use App\Models\Purchase\Purchase;
use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Dashboard', route('home'));
});

Breadcrumbs::for('purchase.purchases.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Purchases', route('purchase.purchases.index'));
});

Breadcrumbs::for('purchase.purchases.create', function ($trail) {
    $trail->parent('purchase.purchases.index');
    $trail->push('Create', route('purchase.purchases.create'));
});

Breadcrumbs::for('purchase.purchases.edit', function ($trail, Purchase $purchase) {
    $trail->parent('purchase.purchases.index');
    $trail->push('Edit', route('purchase.purchases.edit', ['purchase' => $purchase]));
});

Breadcrumbs::for('purchase.purchases.show', function ($trail, Purchase $purchase) {
    $trail->parent('purchase.purchases.index');
    $trail->push($purchase->code, route('purchase.purchases.show', ['purchase' => $purchase]));
});