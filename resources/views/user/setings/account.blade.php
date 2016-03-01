@extends('layouts.master')

@section('title') Acoount Setting @stop

@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-xs-12 col-sm-2 col-md-3 col-lg-4">
				@include('user.setings._sizebar')
	        </div>

	        <div class="col-xs-12 col-sm-10 col-md-9 col-lg-8">
	        	<h2> Update Your Account </h2>
	        	<hr>
				<form class="" novalidate>

				    <div class="form-group">
				        <label>First Name: <sup class="text-danger">*</sup></label>
				        <input type="text" class="form-control" autocomplete="off">
				    </div>

				    <div class="form-group">
				        <button type="submit" class="btn btn-primary">
				            Update Account
				        </button>
				    </div>

				</form>
	        </div>
	    </div>
	</div>
@stop
