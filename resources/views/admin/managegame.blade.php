@extends('admin.layouts.master')

@section('content')
    <h3 class="page-title"> Manage Games
        <small>
            @foreach($games as $game)
                @if($game-> id == $id)
                    {{$game_name = $game->name}}
                @endif
            @endforeach
        </small>
    </h3>
    {!! Breadcrumbs::render('order') !!}
    <div class="profile-content">
        <div class="row">
            <div class="col-md-12">

                <manage-game id="{{$id}}">
                    <div class="caption" slot="header">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Manager game {{$game_name}}</span>
                    </div>
                </managame>

            </div>
        </div>
    </div>

@stop
