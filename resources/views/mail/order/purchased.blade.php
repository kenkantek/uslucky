@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => "Hello $senderName",
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')
<style>
    .col-md-4{
    width:38%;
    float:left;
    padding:5px;
}

.col-md-8{
    width:50%;
    float:left;
    padding:5px;
}

.col-md-12{
    width:100%;
    padding:5px;
    float:left;
}

.col{
    float: left;
    width: 50%;
}

h4{
    font-size: 18px;
}

ul{
    padding-left:0;
  }
.list{
      position: relative;
      overflow: hidden;
      display: inline-block;
      margin: 0;
      text-align: left;

  }

  .list .powerball{
          background-color:#F06;
          color:#ffffff;
        }

  .list li{
        position: relative;
        float: left;
        text-align: center;
        background: #FEC732;
        color: #000000;
        text-decoration: none;
        font-size: 14px;
        line-height: 27px;
        width: 29px;
        height: 24px;
        font-weight: bold;
        border-radius: 50%;
        margin-left: 1px;
        list-style-type:none;
        margin:10px 5px 10px 5px;
        padding-top:5px;
      }
</style>
        <p>Your order #{{ $order->id }} was @if($order->status->status == 'purchased') <span style="color: green; font-weight: bold;">purchased</span> @elseif($order->status->status == 'canceled') <span style="color: red; font-weight: bold;">canceled</span> @else change to <span style="color: red; font-weight: bold;">wait for purchase</span> @endif!</p>
        <div style="margin-bottom: 20px; float: left;">
            <div class="col">
                <div class="col-md-4">
                    <strong>Bought date:</strong>
                </div>
                <div class="col-md-8">
                    {{ $order->created_at}}
                </div>
                <div class="col-md-4">
                    <strong>Draw date:</strong>
                </div>
                <div class="col-md-8">
                    {{$order->draw_at}}
                </div>
                <div class="col-md-12">
                    <strong>Description:</strong>
                    <br> {{$order->description}}
                </div>
            </div>
        <div class="col">
            <div class="col-md-4">
                <strong>Game</strong>
            </div>
            <div class="col-md-8">
                {{$order->game_name}}
            </div>
            <div class="col-md-4">
                <strong>Extra:</strong>
            </div>
            <div class="col-md-8">
                @if($order->extra == 0) No @else Yes @endif
            </div>
            <div class="col-md-4">
                <strong>Price total:</strong>
            </div>
            <div class="col-md-8">
                USD ${{number_format($order->price,2)}}
            </div>
        </div>
    </div>
        <table border="1" style="border-collapse:collapse; width: 100%; border: 1px solid #aaa;">
            <thead style="background-color: #D16D66; color: white; font-weight: bold;">
            <tr>
                <th>Number</th>
            </tr>
            </thead>
            @foreach($order->tickets as $key => $ticket)
            <tr>
                <td align="center" style="height: 35px">
                    <ul class="list">
                        @foreach($ticket->numbers as $key => $number)
                        <li>{{$number}}</li>
                        @endforeach
                        <li class="powerball">{{$ticket->ball}}</li>
                    </ul>
                </td>
            </tr>
            @endforeach
        </table>
    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
            'title' => 'Click me to go to USLUCKY',
            'link' => env('BASE_URI')
    ])

@stop
