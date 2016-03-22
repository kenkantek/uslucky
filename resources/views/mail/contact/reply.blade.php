@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => "Hello $senderName",
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p>This is reply your contact from {{env('TITLE')}}</p>
        <p><strong>Uslucky:</strong></p>
        <p>{{$content->reply_content}}</p>
        <p><i><strong>Your message:</strong></i></p>
        <p><i>{{$content->message}}</i></p>
    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
            'title' => 'Click me to go to USLUCKY',
            'link' => env('BASE_URI')
    ])

@stop
