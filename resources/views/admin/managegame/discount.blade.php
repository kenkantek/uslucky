@extends('admin.layouts.master')

@section('content')

    {!! Breadcrumbs::render('managegame.discount', $game) !!}

    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-green"></i>
                            <span class="caption-subject font-green sbold uppercase">{{ $game->name }} discount</span>
                        </div>

                    </div>
                    <div class="portlet-body">
                        <game-discount :game="{{ $game }}"></game-discount>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
