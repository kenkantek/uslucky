<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2><img src="{{asset('css/images/logo.png')}}" alt=""></h2>

<div>
	Dear {{$event->first_name}},
    Thanks for creating an account with the verification US Lucky.
    Please follow the link below to verify your email address
    {{ route('front::register.verify', $event->active_code) }}.<br/>

</div>

</body>
</html>
