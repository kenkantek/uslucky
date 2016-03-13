@extends('layouts.master')

@section('body-class','history')

@section('title') Transacsion history @stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-2 col-md-3 col-lg-4">
                @include('user.setings._sizebar')
            </div>

            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-8">
                <h2> Your Transacsion History </h2>
                <hr>
                <table class="table table-bordered table-hover trans">
                    <thead>
                        <tr>

                            <th>Date</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Blance</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($histories as $key => $history)
                        <tr>

                            <td>{{$history->created_at}}</td>
                            <td>{!!$history->description!!}</td>
                            <td>&#36;{{number_format($history->amount,2)}}</td>
                            <td>&#36;{{number_format($history->amount,2)}}</td>
                            <td>{{$history->status->status}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td>NODATA</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <hr>
                {{ $histories->links() }}
            </div>
        </div>
    </div>
@stop
