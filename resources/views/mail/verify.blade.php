<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Verify Your Email Address</h2>

<div>
    Thanks for creating an account with the verification US Lucky.
    Please follow the link below to verify your email address
    {{ route('front::register.verify', $event->active_code) }}.<br/>

</div>

</body>
</html>
