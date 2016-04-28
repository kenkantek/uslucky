@extends('layouts.master')

@section('title', 'About Us')

@section('content')
<div class="bg4 p50">
        <div class="container">
            <div class="col-md-12">
                <h2>{{trans('about.title', ['title'=>env('TITLE')])}}</h2>

                <div class="block1">
                    <div class="left"><img src="{{asset('images/ticketscan.png')}}" alt=""></div>
                    <h5><a href="#">{{trans('about.sub_title')}}</a></h5>
                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <div class="addthis_sharing_toolbox"></div>
                    <p>{{trans('about.details')}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg3 p50">
        <div class="container">
            <div class="col-md-12">
                <h2>{{trans('about.why_choose_us')}}</h2>

                <div class="col-md-4">
                    <div class="thumb1">
                        <div class="circle">1</div>
                        <h5><a href="#">{{trans('about.step_1')}}</a></h5>

                        <p>{{trans('about.des_1')}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumb1">
                        <div class="circle">2</div>
                        <h5><a href="#">{{trans('about.step_2')}}</a></h5>

                        <p>{{trans('about.des_2')}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumb1">
                        <div class="circle">3</div>
                        <h5><a href="#">{{trans('about.step_3')}}</a></h5>

                        <p>{{trans('about.des_3')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="bg2 p44">
        <div class="container">
            <div class="col-md-12">
                <h2 class="gray">{{trans('about.testimonials')}}</h2>
            </div>
            <div class="col-md-6">
                <div class="bq">
                    <div class="col-md-4">
                        <div class="img">
                            <span><i class="fa fa-quote-left"></i></span>
                            <img src="{{asset('images/page2_img3.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <p>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui...</p>
                        <a href="#">Olivia pool</a>
                        <b>manager</b>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bq">
                    <div class="col-md-4">
                        <div class="img">
                            <span><i class="fa fa-quote-left"></i></span>
                            <img src="{{asset('images/page2_img4.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <p>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dui...</p>
                        <a href="#">Mark Johnson</a>
                        <b>manager</b>
                    </div>
                </div>
            </div>

        </div>
    </div>--}}
@stop
