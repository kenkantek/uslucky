<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<table align="center">
    <tbody>
        <tr>
            <td></td>
            <td bgcolor="#ffffff">
                <div>
                    <table cellspacing="0" width="580" align="center" border="0">
                        <tbody>
                            <tr>
                                <td>
                                    <a href="{{env('BASE_URI')}}" target="_blank"><img border="0" alt="uslucky – play the world’s biggest lotteries anywhere anytime" src="{{asset('css/images/logo.png')}}" height="100" class="CToWUd"></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="MARGIN-TOP:10px">
                    @yield('content')
                </div>
            </td>
            <td></td>
        </tr>
    </tbody>
</table>

</body>
</html>
