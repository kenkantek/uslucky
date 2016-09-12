@extends('admin.layouts.master')

@section('content')

{!! Breadcrumbs::render('contact') !!}

<div class="app-ticket app-ticket-list">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Partner List</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <partners></partners>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
