@extends('mail.layouts.master')

@section('content')
<table style="FONT-SIZE:16px;FONT-FAMILY:Arial,Helvetica,sans-serif;COLOR:#3f3f3f;LINE-HEIGHT:20px" width="580" align="center">
    <tbody>
        <tr>
            <td>
                <h2>Congratulation {{ $senderName }},</h2>
                <h4>YOUR ARE WINNER!</h4>
                <p>Your are winner in {{$award->order->game->name}}. Ticket was bought at {{$award->order->created_at}}.</p>
                <p>Draw date at: {{$award->order->draw_at}}. Order #{{$award->order->id}}</p>
                <table cellspacing="0" style="padding:0;font-family:Arial;color:#505050;font-size:14px;border:1px solid #e3e3e3;width:250px">
                    <tbody>
                        <tr>
                            <td>
                                <table style="width:100%;border:none" border="0" cellspacing="0">
                                    <tbody>
                                        <tr style="background-color:#f8f8f8">
                                            <td style="font-family:Arial;font-size:14px;height:30px;color:#4677c4;padding-top:5px;padding-bottom:5px;border-bottom:solid 1px #e3e3e3;vertical-align:middle;padding-left:3px" colspan="2" nowrap=""><strong style="color:#4677c4">{{$award->ticket_total}} Your win number.</strong></td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top:3px">
                                                <table style="border:none">
                                                    <tbody>
                                                            <tr>
                                                            <td style="font-family:Arial;font-size:14px;color:#505050;font-weight:bold;padding-right:5px;text-align:left;line-height:20px">#</td>
                                                            @foreach($award->numbers as $number)
                                                            <td style="font-family:Arial;font-size:14px;color:#505050;width:22px;line-height:20px;text-align:center;padding-left:3px"><span>{{$number}},</span></td>
                                                            @endforeach

                                                            <td style="font-family:Arial;font-size:14px;color:#505050;width:22px;line-height:20px;text-align:center;padding-left:3px"><span style="color:#e32e35">{{$award->ball}}</span></td>
                                                        </tr>



                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p></p>

                <p><h2>Your award value: ${{number_format($prizeMoney, 2)}}</h2>

                </p>
                <p>{{$award->level->label}}</p>
                <p></p>
                <p>For more details about this transaction, please visit <a href="{{env('BASE_URI')}}" target="_blank">My Account</a>.</p>
                <p>Wishing you the best of luck in the lotteries,</p>
                <p>Customer Support Team
                    <br>uslucky.com</p>
                <p>
                    <a href="{{env('BASE_URI')}}" target="_blank">
                        <br>
                    </a>
                </p>
            </td>
        </tr>
        <tr>
            <td height="30"></td>
        </tr>
    </tbody>
</table>
@stop
