@extends('admin.layouts.master')

@section('title') Manage Discounts @stop

@section('content')
    
    <h3 class="page-title"> Manage Discounts
        <small>All dicounts</small>
    </h3>
    
    {!! Breadcrumbs::render('discount') !!}

    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">All dicounts</span>
                        </div>
                        <div class="actions">
                            <a href="{{ route('admin.discount.create') }}" class="btn btn-circle btn-default">
                                <i class="fa fa-plus"></i> Add 
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <discount></discount>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@stop
