@extends('admin.layouts.master')

@section('title') All Categories @stop

@section('content')
    <h3 class="page-title"> Manage Categories
        <small>Categories</small>
    </h3>

    {!! Breadcrumbs::render('ecommerce.category.create') !!}

    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <ecommerce-category-create>
                </ecommerce-category-create>
            </div>
        </div>
    </div>
@stop
