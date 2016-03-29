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
                    <table style="FONT-SIZE:16px;FONT-FAMILY:Arial,Helvetica,sans-serif;COLOR:#3f3f3f;LINE-HEIGHT:20px" width="580" align="center">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center">
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td bgcolor="#ffffff">
                                                    <div>
                                                        <table style="LINE-HEIGHT:1.5;FONT-FAMILY:Arial,Helvetica,sans-serif;COLOR:#3f3f3f;FONT-SIZE:16px" width="580" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <p>Dear {{$event->first_name}},
                                                                            <br><a style="COLOR:#4677c4;FONT-SIZE:26px;FONT-WEIGHT:bold;TEXT-DECORATION:none" href="{{ route('front::register.verify', $event->active_code) }}" target="_blank">Welcome to uslucky.com</a></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="10" align="left">Please follow the link below to verify your email address
    {{ route('front::register.verify', $event->active_code) }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">
                                                                        <p>Welcome to a new world! Get ready to play the most exciting lotteries on the planet!
                                                                            <br>Your email to login site is as follows: {{$event->email}}
                                                                            <br>
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="10" align="left"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <a href="{{ route('front::register.verify', $event->active_code) }}" target="_blank"><img style="COLOR:#88d6f8;FONT-SIZE:24px" border="0" alt="Welcome" src="{{asset('images/WelcomeImage.jpg')}}" width="580" height="198" class="CToWUd"></a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div>
                                                        <table style="LINE-HEIGHT:1.5;FONT-FAMILY:Arial,Helvetica,sans-serif;COLOR:#3f3f3f;FONT-SIZE:16px" width="580" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td height="10" align="left"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">
                                                                        <p><strong>Join in the Fun</strong>
                                                                            <br>You’re one click away from playing the biggest lottery draws!
                                                                            <br>
                                                                            <br><strong>Save Money &amp; Boost Odds</strong>
                                                                            <br>Experience our vast array of play options: from odds-boosting syndicates.</p>
                                                                        <p><strong>Get Lottery Results &amp; Info</strong>
                                                                            <br>Get all the info you need on our website! </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="10" align="left"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left"><a style="COLOR:#4677c4;FONT-SIZE:26px;FONT-WEIGHT:bold;TEXT-DECORATION:none" href="{{ route('front::register.verify', $event->active_code) }}" target="_blank">How it Works</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="10" align="left"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">1. Select the lottery you’d like to play.
                                                                        <br>2. Deposit with secure and easy payment methods.
                                                                        <br>3. See your scanned ticket online.
                                                                        <br>4. Receive automatic winning notifications and get paid swiftly!
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="20"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#d7d7d7" align="left"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="20"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="10"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left"><a style="COLOR:#4677c4;FONT-SIZE:26px;FONT-WEIGHT:bold;TEXT-DECORATION:none" href="{{ route('front::register.verify', $event->active_code) }}" target="_blank">Increase your Chances to Win</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="10"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">Our exclusive online syndicates dramatically increase your chances to win as you play draws with more lines than ever before! With Bundles, you combine these syndicates in a package deal, giving you unbeatable odds and a very sharp price: the Best of Both Worlds! </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#d7d7d7" align="left"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="40"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="middle">
                                                                        <a href="{{ route('front::register.verify', $event->active_code) }}" target="_blank"><img border="0" alt="See Your Ticket" src="https://www.thelotter.com/objects/MailTemplates/2015/Activity/images/SeeYourTicket_Image.jpg" width="253" height="243" class="CToWUd"></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="10"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="middle"><a style="COLOR:#4677c4;FONT-SIZE:26px;FONT-WEIGHT:bold;TEXT-DECORATION:none" href="h{{ route('front::register.verify', $event->active_code) }}" target="_blank">See Your Ticket</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="middle">See your scanned ticket in your secure online account!</td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="40"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="middle">
                                                                        <a href="{{ route('front::register.verify', $event->active_code) }}" target="_blank"><img border="0" alt="Free Services" src="https://www.thelotter.com/objects/MailTemplates/2015/Activity/images/FreeServices.jpg" width="253" height="253" class="CToWUd"></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="middle"><a style="COLOR:#4677c4;FONT-SIZE:26px;FONT-WEIGHT:bold;TEXT-DECORATION:none" href="{{ route('front::register.verify', $event->active_code) }}" target="_blank">Free Services</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="middle">Enjoy free result and jackpot alerts as well as winning notifications!</td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="40"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="middle">
                                                                        <a href="{{ route('front::register.verify', $event->active_code) }}" target="_blank"><img border="0" alt="Customer Care" src="https://www.thelotter.com/objects/MailTemplates/2015/Activity/images/24_7_Image.jpg" width="253" height="253" class="CToWUd"></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="middle"><a style="COLOR:#4677c4;FONT-SIZE:26px;FONT-WEIGHT:bold;TEXT-DECORATION:none" href="{{ route('front::register.verify', $event->active_code) }}" target="_blank">Customer Care</a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="middle">Our friendly experts are available 24/7 via email, chat and telephone. </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="middle">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td bgcolor="#d7d7d7" align="left"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div></div>
                                                    <div>
                                                        <table style="LINE-HEIGHT:1.5;FONT-FAMILY:Arial,Helvetica,sans-serif;COLOR:#3f3f3f;FONT-SIZE:16px" width="580" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td height="40" align="left"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">Best wishes,
                                                                        <br>Customer Service Team
                                                                        <br><a style="COLOR:#4677c4;FONT-WEIGHT:bold;TEXT-DECORATION:none" href="{{ route('front::register.verify', $event->active_code) }}" target="_blank">uslucky.com</a> </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="30"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </td>
            <td></td>
        </tr>
    </tbody>
</table>


</div>

</body>
</html>
