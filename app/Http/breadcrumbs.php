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

Breadcrumbs::register('ticket', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Tickets', route('admin.tickets.index'));
});
