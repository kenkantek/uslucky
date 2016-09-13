@extends('layouts.master')
@section('content')
<div class="bg4 p9">
	<div class="container">
		<div class="row partner">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-header">
				<img src="img/unnamed.png" class="img-responsive" alt="" style="width:135px; height:60px; float:right; padding:10px 10px 0 0">
				<p class="bg-title"><span style="color:#fefd0c;">Free</span> marketing for you restaurant</p>
				<hr>
				<hr>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main">
				<div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 padding-left">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><img src="img/unnamed (5).png" class="img-responsive img-220" alt="" style="height: 200px;width: auto"></div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><img src="img/unnamed (6).png" class="img-responsive img-220" alt="" style="height: 200px;width: auto"></div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<p>Free Marketing</p>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg2">
						<div class="row paddinglr"> <img src="img/unnamed (3).png" alt="" class="img-responsive" style="float:left; width:144px; height:150px">
							<p>We bring Chinese tourists to your restaurant</p>
						</div>
						<div class="row paddinglr2">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> <img src="img/air.png" alt="" class="img-responsive" > </div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-right-10"> <img src="img/eat.png" alt="" class="img-responsive" style="float:left;width:100%"> </div>
						</div>
						<div class="row paddinglr">
							<p>150,000,000 Chinese<br>
								traveling abroad every year </p>
						</div>
					</div>
				</div>
				<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 bg3">
					<ul>
						<li>uslucky.com, a tech startup recommending high quality restaurants to Chinese tourists</li>
						<li>100% free marketing to our partner restaurants; paid by travel agencies</li>
						<li>100k+members getting our recommendations and growing everday</li>
						<li>hundreds of restaurants already working with us</li>
					</ul>
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main">
				<div class="hr1"></div>
				<div class="bg4">
					<p>How to get started?</p>
				</div>
				<div class="hr2"></div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 main-left ">
					<ul>
						<li><span>Call us and share your best dishes</span></li>
						<li><span>Let us write Chinese promotion blogs for you</span></li>
						<li><span>Join our program to offer a 10% discount to our members</span></li>
					</ul>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 "> <img src="img/vip.png" class="img-responsive" alt=""></div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main3">
				<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 info">
					<p><i class="fa fa-map-marker" aria-hidden="true"></i> 85 broad st,17 Fl</p>
					<p style="padding-left:22px;">New York, Ny 10004</p>
				</div>
				<div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 info">
					<p><i class="fa fa-envelope" aria-hidden="true"></i> marketing@uslucky.com</p>
					<p><i class="fa fa-phone" aria-hidden="true"></i> (888) 587-6885</p>
				</div>
			</div>
			<div class="col-md-8 col-md-offset-2" style="padding-top: 20px">
				<center><h2>Partnership register</h2></center>
				<contact-partner inline-template>
					<form @submit.prevent="onSubmit" novalidate>
						<div class="form-group" :class="{'has-error': formErrors.name}">
							<label style="font-weight: normal" for="name">Company Name</label>
							<input type="text" v-model="formInputs.name" class="form-control">
							<span class="help-block" v-show="formErrors.name" v-text="formErrors.name"></span>
						</div>
						<div class="form-group">
							<label style="font-weight: normal" for="address">Address</label>
							<input type="text" v-model="formInputs.address" class="form-control">
						</div>
						{{--<div class="form-group">--}}
							{{--<label for="zipcode">Company Zipcode</label>--}}
							{{--<input type="text" v-model="formInputs.zipcode" class="form-control" value=" ">--}}
						{{--</div>--}}
						<div class="form-group">
							<label style="font-weight: normal" for="phone">Telephone</label>
							<input type="text" v-model="formInputs.phone" class="form-control">
						</div>
						<div class="form-group">
							<label style="font-weight: normal" for="contact_person">Contact Person</label>
							<input type="text" v-model="formInputs.contact_person" class="form-control">
						</div>
						<div class="form-group">
							<label style="font-weight: normal" for="cell_phone">Mobil</label>
							<input type="text" v-model="formInputs.cell_phone" class="form-control">
						</div>
						<div class="form-group">
							<label style="font-weight: normal" for="message">Message</label>
							<textarea v-model="formInputs.message" class="form-control" cols="30" rows="10"></textarea>
						</div>
						<div class="form-group" style="text-align: center">
							<button :disabled="submiting" type="submit" class="btn btn-primary"><i class="fa fa-circle-o-notch fa-spin" v-show="submiting"></i> Submit</button>
							<button type="reset" class="btn btn-warning">Reset</button>
						</div>
					</form>
				</contact-partner>
			</div>

		</div>
	</div>
</div>

@stop