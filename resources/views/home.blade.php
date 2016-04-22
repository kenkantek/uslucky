@extends('layouts.master')

@section('extends_content')
    <div class="unit">
        <div class="title1">
            {{Carbon\Carbon::createFromTimestamp(strtotime($powerball['time']))->formatLocalized('%A, %B %d')}} Jackpot:
        </div>
        <div class="title2">
            @if($powerball['amount'] == "Not Published")
                {{$powerball['amount']}}
            @else
                {{niceNumber($powerball['amount'])}}
            @endif
        </div>
        @if($result)
        <div class="col-md-6 left">
            <p>
                <time datetime="{{Carbon\Carbon::createFromTimestamp(strtotime($result->draw_at))}}">
                    {{Carbon\Carbon::createFromTimestamp(strtotime($result->draw_at))->formatLocalized('%A, %B %d')}}
                </time>
                &nbsp;|&nbsp;{{trans('home.win_number')}}:
            </p>
        </div>
        @endif
        <div class="col-md-6 right">
            <ul class="list">
                @if($result)
                    @forelse($result->numbers as $number)
                        <li>{{$number}}</li>
                    @empty
                        <li>No</li>
                    @endforelse
                        <li>{{$result->ball}}</li>
                @endif
            </ul>
            @if($result)
            <div class="ticket">
                <a href="{{route('front::get.winning.numbers')}}">{!! trans('home.current') !!}</a>
            </div>
            @endif
        </div>

    </div>

@stop

@section('content')
<div class="bg2 p29">
        <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-6">
                    <div class="game">
                        <h3>Powerball <br><span style="text-transform: capitalize;">
                            @if($powerball['amount'] == "Not Published")
                                {{$powerball['amount']}}
                            @else
                                ${{niceNumber($powerball['amount'])}}
                            @endif
                            </span></h3>
                        <p>{{trans('home.button')}}:
                            @if($powerball['amount'] == "Not Published")
                                {{$powerball['amount']}}
                            @else
                                ${{niceNumber($powerball['cash_option'])}}
                            @endif
                        </p>

                        <p>{!! trans('home.next') !!}: <span>{{Carbon\Carbon::createFromTimestamp(strtotime($powerball['time']))->formatLocalized('%B %d')}}</span></p>
                        <ul class="list">
                            @if($result)
                                @forelse($result->numbers as $number)
                                    <li>{{$number}}</li>
                                @empty
                                    <li>No</li>
                                @endforelse
                                    <li>{{$result->ball}}</li>
                            @else
                                <li>No</li>
                            @endif
                        </ul>
                        <p>
                            <a class="link home_page" href="{{route('front::game.powerball')}}">{{trans('home.button')}}</a>
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="game">
                        <h3>Mega Millions <br>$26.0 <span>Million</span></h3>

                        <p>{{trans('home.button')}}: $102.0 <span>Million</span></p>

                        <p>{!! trans('home.next') !!}: <span>MAY 31</span></p>
                        <ul class="list">
                            <li>19</li>
                            <li>24</li>
                            <li>45</li>
                            <li>18</li>
                            <li>36</li>
                            <li>5</li>
                        </ul>
                        <p>
                            <a class="link home_page" href="#">{{trans('home.button')}}</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="bg3">
        <div class="container">
            <div class="col-md-4">
                <div class="image">
                    <img src="{{asset('images/page1_img1.png')}}" alt="">
                </div>
            </div>

            <div class="col-md-8">
                <div class="block">
                    <h2>{!! trans('home.h2') !!}</h2>

                    <div class="col-md-6 alpha">
                        <a href="#" class="link1">{{trans('home.how')}}</a>

                        <p>Praesent vestibulum aenean nonummy hendrerit mauris. Hasellus porta. Fusce suscipit varius
                            mi.
                            Cum sociis atoque penatibus magnis dis parturient montes nascetur ridiculus mus. </p>
                    </div>

                    <div class="col-md-6 omega">
                        <ul class="links">
                            <li><a href="#" class="col1">for <br>players</a></li>
                            <li><a href="#" class="col2">for <br>retailers</a></li>
                            <li><a href="#" class="col3">message <br>center</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg4 p47">
        <div class="container">
            <div class="col-md-12">
                <h2>{{trans('home.winners')}}:</h2>
            </div>

            <div class="col-md-12">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img3.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="images/page1_img2.jpg" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img4.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img5.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img3.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img2.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img4.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img5.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img3.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img2.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img4.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img5.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img3.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img2.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img4.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="thumb">
                                    <img src="{{asset('images/page1_img5.jpg')}}" alt="">

                                    <div class="caption">
                                        <a href="#" title="">Richard Clark</a>

                                        <p>Won $1.000 <span>playing <br>$1000 overload</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="fa fa-arrow-circle-right " aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="fa fa-arrow-circle-left " aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg4">
        <div class="container">
            <div class="col-md-3">
                <h4>{{trans('home.ima')}}</h4>
                <ul class="list1">
                    <li><a href="#">Player</a></li>
                    <li><a href="#">Winner! Now what?</a></li>
                    <li><a href="#">Retailer or Want to Be One</a></li>
                    <li><a href="#">Journalist</a></li>
                    <li><a href="#">Job Seeker</a></li>
                    <li><a href="#">Vendor or Want to Be One</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4>{{trans('home.help_me')}}</h4>
                <ul class="list1">
                    <li><a href="#">Find More Ways to Buy</a></li>
                    <li><a href="#">Pick A Game</a></li>
                    <li><a href="#">Play Responsibly</a></li>
                    <li><a href="#">Contact the Lottery</a></li>
                    <li><a href="#">See Supported Browsers</a></li>
                    <li><a href="#">View the Site Better</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4>{{trans('home.show_me')}}</h4>
                <ul class="list1">
                    <li><a href="#">Winning Numbers</a></li>
                    <li><a href="#">Scratchers Games End </a></li>
                    <li><a href="#">How To Claim Prizes</a></li>
                    <li><a href="#">Recent Winners</a></li>
                    <li><a href="#">Odds Of Winning</a></li>
                    <li><a href="#">Where the Money Goes</a></li>
                    <li><a href="#">What’s New on the Website</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4>{{trans('home.social')}}</h4>
                <ul class="list1 asd">
                    <li>
                        <a href="#"><i class="fa fa-twitter-square"></i>  </a>
                        <a href="#"><i class="fa fa-facebook-square"></i>  </a>
                        <a href="#"><i class="fa fa-linkedin-square"></i>  </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@stop
