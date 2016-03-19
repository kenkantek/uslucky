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
                        <span class="caption-subject font-blue-madison bold uppercase">Contact Details #1123</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="ticket-cust">
                                <span class="bold">Customer:</span> Jane (
                                <a href="mailto:customer@gmail.com">customer@gmail.com)</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ticket-date">
                                <span class="bold">Entry Date/Time:</span> 10/12/2015 10:15am </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="ticket-msg">
                                <h3>
                                                                <i class="icon-note"></i> Customer Message</h3>
                                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac purus urna. Nam eu ante orci. Ut sollicitudin tempor dolor a feugiat. Proin sodales molestie nisl ac varius.
                                    <br/>
                                    <br/> Morbi volutpat urna at ultrices lacinia. Integer consectetur justo quis luctus congue. Fusce at sem a ipsum efficitur tincidunt cursus sit amet enim. </p>
                            </div>
                        </div>
                    </div>
                    <div class="ticket-line"></div>
                    <form class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3>
                                                                <i class="icon-action-redo"></i> Ticket Reply</h3>
                                <textarea class="ticket-reply-msg" row="10"></textarea>
                            </div>
                        </div>

                        <button class="btn btn-square uppercase bold green" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
