@extends('layouts.master')

@section('title', 'Special Offers')

@section('content')
    <div class="container">
        <h1>{{$offer->name}}</h1>
        {!! $offer->contents !!}
    </div>
@stop
