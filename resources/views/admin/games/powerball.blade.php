@extends('admin.layouts.master')

@section('content')
<h3 class="page-title"> Manage Games
       <small>PowerBall</small>
   </h3>
   {!! Breadcrumbs::render('order') !!}
   <div class="profile-content">
       <div class="row">
           <div class="col-md-12">
               <!-- BEGIN PORTLET -->
               <powerball>
                   <div class="caption" slot="header">
                       <i class="icon-settings font-dark"></i>
                       <span class="caption-subject font-dark sbold uppercase">Manager game Powerball</span>
                   </div>
               </powerball>
               <!-- END PORTLET -->
           </div>
       </div>
   </div>

@stop
