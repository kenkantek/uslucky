<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('admin.dashboard'), ['icon' => 'icon-home']);
});

Breadcrumbs::register('contact', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Contacts', route('admin.contact.index'));
});

Breadcrumbs::register('contact.show', function ($breadcrumbs, $contact) {
    $breadcrumbs->parent('contact');
    $breadcrumbs->push('Contact #' . $contact->id, route('admin.contact.show', $contact->id));
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
    $breadcrumbs->push('Products', route('ecommerce.admin.ecommerce.product.index'));
});

Breadcrumbs::register('product.create', function ($breadcrumbs) {
    $breadcrumbs->parent('product.index');
    $breadcrumbs->push('Create Product', route('ecommerce.admin.ecommerce.product.create'));
});

Breadcrumbs::register('product.edit', function ($breadcrumbs, $products) {
    $breadcrumbs->parent('product.index');
    $breadcrumbs->push("Update Product #{$products->id}", route('ecommerce.admin.ecommerce.product.edit', $products->id));
});

Breadcrumbs::register('discount', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Manage Discounts', route('admin.discount.index'));
});
Breadcrumbs::register('discount.create', function ($breadcrumbs) {
    $breadcrumbs->parent('discount');
    $breadcrumbs->push('Create discount', route('admin.discount.create'));
});

Breadcrumbs::register('ecommerce.order.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Ecommerce Orders', route('ecommerce.order.index'));
});
Breadcrumbs::register('ecommerce.order.show', function ($breadcrumbs, $order) {
    $breadcrumbs->parent('ecommerce.order.index');
    $breadcrumbs->push("Ecommerce Order #{$order->id}", route('ecommerce.order.show', $order->id));
});

Breadcrumbs::register('ecommerce.category.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Ecommerce Categories', route('ecommerce.admin.ecommerce.category.index'));
});
Breadcrumbs::register('ecommerce.category.create', function ($breadcrumbs) {
    $breadcrumbs->parent('ecommerce.category.index');
    $breadcrumbs->push('Ecommerce Create', route('ecommerce.admin.ecommerce.category.create'));
});
Breadcrumbs::register('ecommerce.category.edit', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('ecommerce.category.index');
    $breadcrumbs->push('Ecommerce Edit #' . $category->name, route('ecommerce.admin.ecommerce.category.edit', $category->id));
});

Breadcrumbs::register('managegame', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Manage Game', 'javascript:;');
});
Breadcrumbs::register('managegame.general', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('managegame');
    $breadcrumbs->push("Game #{$id}", route('admin.games.show', $id));
});
Breadcrumbs::register('managegame.discount', function ($breadcrumbs, $game) {
    $breadcrumbs->parent('managegame');
    $breadcrumbs->push("Discount {$game->name}", route('admin.games.show', $game->id));
});
