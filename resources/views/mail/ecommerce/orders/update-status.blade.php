Hi <strong>{{ $user->fullname }}</strong>,
<br>
<br>
<br>

Order <strong>#{{ $order->id }}</strong> has been update to {{ $order->status->status }}.
<hr>
<p>Thanks. <span style="float: right"><a href="{{ env('BASE_URI') }}">{{ env('TITLE') }}</a></span></p>
