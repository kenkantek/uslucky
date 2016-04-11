@extends('mail.layouts.master')

@section('content')
<table style="FONT-SIZE:16px;FONT-FAMILY:Arial,Helvetica,sans-serif;COLOR:#3f3f3f;LINE-HEIGHT:20px" width="580" align="center">
    <tbody>
        <tr>
            <td>
                <h2>Hi {{ $senderName }},</h2>
                <h4>YOU HAD REQUESTED AN PAYMENT!</h4>
                <p>This is transaction history #{{ $transaction->id }}</p>
                <table cellspacing="1" style="padding:0;font-family:Arial;color:#505050;font-size:14px;border:1px solid #e3e3e3;width:100%; border-collapse:collapse;">
                    <tbody>
                        <tr>
                            <td>
                                <table style="width:100%;border:none" border="0" cellspacing="0">
                                    <tbody>
                                        <tr style="background-color:#f8f8f8">
                                            <td style="font-family:Arial;font-size:14px;height:30px;color:#4677c4;padding-top:5px;padding-bottom:5px;border:solid 1px #e3e3e3;vertical-align:middle;padding-left:3px" nowrap=""><strong style="color:#4677c4">Date claim</strong></td>
                                            <td style="font-family:Arial;font-size:14px;height:30px;color:#4677c4;padding-top:5px;padding-bottom:5px;border:solid 1px #e3e3e3;vertical-align:middle;padding-left:3px" nowrap=""><strong style="color:#4677c4">Amount</strong></td>
                                            <td style="font-family:Arial;font-size:14px;height:30px;color:#4677c4;padding-top:5px;padding-bottom:5px;border:solid 1px #e3e3e3;vertical-align:middle;padding-left:3px" nowrap=""><strong style="color:#4677c4">Your blance</strong></td>
                                            <td style="font-family:Arial;font-size:14px;height:30px;color:#4677c4;padding-top:5px;padding-bottom:5px;border:solid 1px #e3e3e3;vertical-align:middle;padding-left:3px" nowrap=""><strong style="color:#4677c4">Status</strong></td>

                                        </tr>
                                        <tr>
                                            <td style="font-family:Arial;font-size:14px;color:#505050;padding-right:5px;text-align:;line-height:20px;border:solid 1px #e3e3e3;">{{ date('Y-m-d') }}</td>
                                            <td style="font-family:Arial;font-size:14px;color:#505050;line-height:20px;text-align:center;padding-left:3px"><span>&#36;{{number_format($transaction->amount)}}</span></td>
                                            <td style="font-family:Arial;font-size:14px;color:#505050;line-height:20px;border:solid 1px #e3e3e3;text-align:center;padding-left:3px"><span style="color:#e32e35">&#36;{{number_format($transaction->amount_total,2)}}</span></td>
                                            <td style="font-family:Arial;font-size:14px;color:#505050;line-height:20px;border:solid 1px #e3e3e3;text-align:center;padding-left:3px"><span style="color:#e32e35">Pendding</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p></p>

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
