@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => "Hello $senderName",
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p>This is transaction history #{{ $transaction->id }}</p>
        Table detail here.
    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
            'title' => 'Click me to Detail',
            'link' => 'http://google.com'
    ])

@stop
