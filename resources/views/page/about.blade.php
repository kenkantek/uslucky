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
                    <p>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce
                        suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                        ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec,
                        luctus a, lorem. Maecenas tristique orci ac semduis ultricies pharetra magnaonec accumsan.</p>
                    <br>

                    <p>Malesuada orci. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit
                        mauris. Fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget elementum
                        vel cursus eleifend elit. </p><br>

                    <p>Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus.
                        Quisque nulla. Vestibulum libero nisl porta vel scelerisque eget malesua at, neque. Vivamus eget
                        nibh. </p><br>

                    <p>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce
                        suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                        ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc odio, gravida at, cursus nec,
                        luctus a, lorem. Maecenas tristique orci ac semduis ultricies pharetra magnaonec accumsan.
                        Malesuada orci. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit
                        mauris. Fermentum dictum magna. Sed laoreet aliquam leo. </p><br>

                    <p>Ut tellus dolor, dapibus eget elementum vel cursus eleifend elit. Aenean auctor wisi et urna.
                        Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus. Quisque nulla. Vestibulum
                        libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus
                        leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci
                        luctus et ultrices posuere.</p>
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
                        <h5><a href="#">WE BUY</a></h5>

                        <p>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce
                            suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                            ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc.</p>
                        <a href="#" class="link">read more</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumb1">
                        <div class="circle">2</div>
                        <h5><a href="#">WE SCAN</a></h5>

                        <p>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce
                            suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                            ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc.</p>
                        <a href="#" class="link">read more</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="thumb1">
                        <div class="circle">3</div>
                        <h5><a href="#">YOU SEE</a></h5>

                        <p>Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce
                            suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                            ridiculus mus. Nulla dui. Fusce feugiat malesuada odio. Morbi nunc.</p>
                        <a href="#" class="link">read more</a>
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
