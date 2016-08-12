@extends('layouts.master')

@section('title', 'Special Offers')

@section('content')
    <div class="container">
        @if($offer->status == 1)
            <h1>{{$offer->name}}</h1>
            {!! $offer->contents !!}
            @else
            <h1>Not have offer today!</h1>
        @endif
    </div>
@stop
