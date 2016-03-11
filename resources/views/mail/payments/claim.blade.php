@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => "Hello $senderName",
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p>This is transaction history #{{ $transaction->id }}</p>
        <table class="table table-bordered table-hover" style="border:1px solid #aaa; width: 100%">
            <thead style="border:1px solid #aaa;">
                <tr>
                    <th style="border:1px solid #aaa">Date claim</th>
                    <th style="border:1px solid #aaa">Money request</th>
                    <th style="border:1px solid #aaa">Your blance</th>
                    <th style="border:1px solid #aaa">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border:1px solid #aaa">{{$transaction->created_at}}</td>
                    <td style="border:1px solid #aaa">{{$transaction->amount}}</td>
                    <td style="border:1px solid #aaa">{{$transaction->amount_total}}</td>
                    <td style="border:1px solid #aaa">Pending</td>
                </tr>
            </tbody>
        </table>
    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
            'title' => 'Click me to Detail',
            'link' => 'http://google.com'
    ])

@stop
