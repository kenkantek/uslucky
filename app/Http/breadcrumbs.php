<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('admin.dashboard'));
});

Breadcrumbs::register('contact', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Contact', route('admin.contacts'));
});
