<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('admin.dashboard'), ['icon' => 'icon-home']);
});

Breadcrumbs::register('contact', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Contact', route('admin.contacts'));
});

Breadcrumbs::register('user', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Users', route('admin.users.index'));
});

Breadcrumbs::register('winner', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Winners', route('admin.users.winners.index'));
});

Breadcrumbs::register('user.show', function ($breadcrumbs, $users) {
    $breadcrumbs->parent('user');
    $breadcrumbs->push('User details', route('admin.users.show', $users->id));
});

Breadcrumbs::register('order', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Orders', route('admin.orders.index'));
});

Breadcrumbs::register('order.show', function ($breadcrumbs, $orders) {
    $breadcrumbs->parent('order');
    $breadcrumbs->push("Order detail #{$orders->id}", route('admin.orders.show', $orders->id));
});

Breadcrumbs::register('ticket', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Tickets', route('admin.tickets.index'));
});

Breadcrumbs::register('game.result', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Game Result', 'javascript:;');
});
Breadcrumbs::register('result.index', function ($breadcrumbs) {
    $breadcrumbs->parent('game.result');
    $breadcrumbs->push('Daily Results', 'javascript:;');
});
Breadcrumbs::register('result.award.module', function ($breadcrumbs) {
    $breadcrumbs->parent('game.result');
    $breadcrumbs->push('Award Matching Module', route('get.results.awards'));
});

Breadcrumbs::register('result.award.detail', function ($breadcrumbs, $result) {
    $breadcrumbs->parent('result.award.module');
    $breadcrumbs->push("Award Detail Result # {$result->id}", route('get.award.result.detailt', $result->id));
});

Breadcrumbs::register('withdraw', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Withdraws Request', route('admin.claim-winning.index'));
});

Breadcrumbs::register('product.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Product', route('ecommerce.admin.ecommerce.products.index'));
});

Breadcrumbs::register('product.create', function ($breadcrumbs) {
    $breadcrumbs->parent('product.index');
    $breadcrumbs->push('Create Product', route('ecommerce.admin.ecommerce.products.create'));
});
