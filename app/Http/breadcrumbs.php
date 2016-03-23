<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('admin.dashboard'), ['icon' => 'icon-home']);
});

Breadcrumbs::register('contact', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Contact', route('admin.contacts'));
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