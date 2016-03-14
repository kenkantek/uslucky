@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => "Hello $senderName",
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p>This is transaction history #{{ $transaction->id }}</p>
        <table border="1" style="border-collapse:collapse; width: 100%; border: 1px solid #aaa;">
            <thead style="background-color: #D16D66; color: white; font-weight: bold;">
                <tr style="height: 35px">
                    <th>Date claim</th>
                    <th>Money request</th>
                    <th>Your blance</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="height: 35px">
                    <td>{{ date('Y-m-d') }}</td>
                    <td>&#36;{{number_format($transaction->amount,2)}}</td>
                    <td>&#36;{{number_format($transaction->amount_total,2)}}</td>
                    <td>Pending</td>
                </tr>
            </tbody>
        </table>
    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
            'title' => 'Click me to Detail',
            'link' => 'http://google.com'
    ])

@stop
