@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Thank you for your register!</div>

                    <div class="panel-body">
                        @if(!empty($flash_mes))
                            @if($flash_mes == 'success')

                                Thank you! We had sent an email to verify, please check inbox/spam or junk mail. <br>
                                If you don't receive, please <a
                                        href="{{url(route('front::register.resend.email'))}}">click here to resend
                                    this email</a>.

                            @elseif($flash_mes == 'resent')
                                Your email verify was sent! Thank you!
                            @elseif($flash_mes == 'verify')
                                Thank you! Your email was verified! <a href="{{url(route('front::settings.account'))}}">Click here to go to your profile.</a>!
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
