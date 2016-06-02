Hi <strong>{{ $user->fullname }}</strong>,
<br>
<br>
<br>

You has been create Ecommerce order <strong>#{{ $order->id }}</strong>.
<hr>
<p>Thanks. <span style="float: right"><a href="{{ env('BASE_URI') }}">{{ env('TITLE') }}</a></span></p>
