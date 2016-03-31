<html>
<head>
<style>
body {
    margin: 0;
    padding: 0;
    background-color: #FAFAFA;
    font: 12pt "Tohoma";
}

.col-md-4{
    width:38%;
    float:left;
    padding:5px;
}

.col-md-8{
    width:58%;
    float:left;
    padding:5px;
}

.col-md-12{
    width:100%;
    padding:5px;
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
        height: 29px;
        font-weight: bold;
        border-radius: 28px;
        margin-left: 1px;
        list-style-type:none;
        margin:10px 5px 10px 5px;
      }

* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

.page {
    width: 21cm;
    overflow: hidden;
    min-height: 297mm;
    padding: 2.5cm;
    margin-left: auto;
    margin-right: auto;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.subpage {
    padding: 1cm;
    border: 5px red solid;
    height: 237mm;
    outline: 2cm #FFEAEA solid;
}

button {
    width: 100px;
    height: 24px;
}

.header {
    overflow: hidden;
}

@page {
    size: A4;
    margin: 0;
}

.logo {
    background-color: #FFFFFF;
    text-align: center;
}

.company {
    padding-top: 24px;
    text-transform: uppercase;
    background-color: #FFFFFF;
    text-align: right;
    float: right;
    font-size: 16px;
}

.title {
    text-align: center;
    position: relative;
    color: #0000FF;
    font-size: 24px;
    top: 1px;
}

.footer-left {
    text-align: center;
    text-transform: uppercase;
    padding-top: 24px;
    position: relative;
    height: 150px;
    width: 50%;
    color: #000;
    float: left;
    font-size: 12px;
    bottom: 1px;
}

.footer-right {
    text-align: center;
    text-transform: uppercase;
    padding-top: 24px;
    position: relative;
    height: 150px;
    width: 50%;
    color: #000;
    font-size: 12px;
    float: right;
    bottom: 1px;
}

.TableData {
    background: #ffffff;
    font: 11px;
    width: 100%;
    border-collapse: collapse;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 12px;
    border: thin solid #d3d3d3;
}

.TableData TH {
    background: rgba(0, 0, 255, 0.1);
    text-align: center;
    font-weight: bold;
    color: #000;
    border: solid 1px #ccc;
    height: 24px;
}

.TableData TR {
    height: 24px;
    border: thin solid #d3d3d3;
}

.TableData TR TD {
    padding-right: 2px;
    padding-left: 2px;
    border: thin solid #d3d3d3;
}

.TableData TR:hover {
    background: rgba(0, 0, 0, 0.05);
}

.TableData .cotSTT {
    text-align: center;
    width: 10%;
}

.TableData .cotTenSanPham {
    text-align: left;
    width: 40%;
}

.TableData .cotHangSanXuat {
    text-align: left;
    width: 20%;
}

.TableData .cotGia {
    text-align: right;
    width: 120px;
}

.TableData .cotSoLuong {
    text-align: center;
    width: 50px;
}

.TableData .cotSo {
    text-align: right;
    width: 120px;
}

.TableData .tong {
    text-align: right;
    font-weight: bold;
    text-transform: uppercase;
    padding-right: 4px;
}

.TableData .cotSoLuong input {
    text-align: center;
}

@media print {
    @page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
    }
}
</style>
</head>
<body onload="window.print()">
@foreach($orders as $key => $order)
<div id="page" class="page">
    <div class="header">
        <div class="logo"><img src="{{asset('css/images/logo.png')}}"/></div>
    </div>
  <br/>
  <div class="title">
        ORDER DETAILS #{{$order->id}}
        <br/>
        -------oOo-------
        <br>
        {{$order->user->fullname}}<br>
        {{$order->user->email}}
  </div>
  <br/>
  <br/>
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
  <table class="TableData">
    <tr>
      <th width="10%">#</th>
      <th>Number</th>
    </tr>
    @foreach($order->tickets as $key => $ticket)
    <tr>
      <td align="center">{{$ticket->id}}</td>
      <td align="center">
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
  <div class="footer-right"> US, {{date("D - m - Y")}} </div>
</div>
@endforeach
</body>
</html>
