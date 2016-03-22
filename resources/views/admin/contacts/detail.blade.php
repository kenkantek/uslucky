@extends('admin.layouts.master')
@section('css')
<link href="{{asset('admin/assets/apps/css/ticket.min.css')}}" rel="stylesheet" type="text/css">
@stop
@section('content')
<div class="app-ticket app-ticket-details">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="icon-globe theme-font hide"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Contact Details #{{$contact->id}}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="ticket-cust">
                                <span class="bold">Customer:</span> {{$contact->name}} (
                                <a href="mailto:{{$contact->email}}">{{$contact->email}}</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ticket-date">
                                <span class="bold">Entry Date/Time:</span> {{$contact->created_at}} </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="ticket-msg">
                                <h3><i class="icon-note"></i> Customer Message</h3> {{$contact->message}}
                            </div>
                        </div>
                    </div>
                    <div class="ticket-line"></div>
                    @if($contact->status == 'replied')
                        <div class="row">
                            <div class="col-xs-12">
                                <h3><i class="icon-action-redo"></i> Replied:</h3>
                                <p>{{$contact->reply_content}}</p>
                            </div>
                        </div>
                    @else
                        <reply-contact id="{{$contact->id}}"></reply-contact>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@stop
