<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
Hi,
<p>This is infomation of company want to register to partnership!</p>
<p><strong>Uslucky:</strong></p>
<p>Company name: {{$partner->name}}</p>
<p>Company address: {{$partner->address}}</p>
<p>Company zipcode: {{$partner->zipcode}}</p>
<p>Company phone: {{$partner->phone}}</p>
<p>Contact person: {{$partner->contact_person}}</p>
<p>Cell phone: {{$partner->cell_phone}}</p>
<p><i><strong>Message:</strong></i></p>
<p><i>{{$partner->message}}</i></p>
</body>
</html>