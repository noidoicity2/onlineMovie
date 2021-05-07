@extends('client.layout.mainLayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="slider">
                    <div id="demo" class="carousel slide" data-ride="carousel">
                        <ul class="carousel-indicators">
                            @for($i = 0 ; $i < $sliders->count() ; $i++)
                                @if($i==0)
                                <li data-target="#demo" data-slide-to="{{$i}}" class="active"></li>
                                @else
                                    <li data-target="#demo" data-slide-to="{{$i}}" class=""></li>
                                @endif

                            @endfor
{{--                            <li data-target="#demo" data-slide-to="0" class="active"></li>--}}
{{--                            <li data-target="#demo" data-slide-to="1"></li>--}}
{{--                            <li data-target="#demo" data-slide-to="2"></li>--}}
                        </ul>
                        <div class="carousel-inner">
{{--                            <div class="carousel-item active">--}}
{{--                                <img loading="lazy" src="/images/bg-3.jpg" alt="Los Angeles" width="1100" height="500">--}}
{{--                                <div class="carousel-caption">--}}
{{--                                    <h3>Los Angeles</h3>--}}
{{--                                    <p>We had such a great time in LA!</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        <?php $tmp = 0   ?>
                            @foreach($sliders as $slider)
                                @if($tmp == 0)
                                <div class="carousel-item active">
                                    <a href="{{route('get_movie_by_slug' , ['slug' => $slider->movie->slug , 'id' => $slider->movie_id])}}">     <img style="max-height: 500px" loading="lazy" src="{{$slider->image_url}}" alt="Chicago" width="1100" height="500"></a>
                                </div>
                                @else
                                    <div class="carousel-item ">
                                        <a href="{{route('get_movie_by_slug' , ['slug' => $slider->movie->slug , 'id' => $slider->movie_id])}}">     <img style="max-height: 400px"  loading="lazy" src="{{$slider->image_url}}" alt="Chicago" width="1100" height="500"></a>
                                    </div>
                                @endif
                                <?php $tmp++   ?>
                            @endforeach
{{--                            <div class="carousel-item active">--}}
{{--                                <a href="">     <img loading="lazy" src="/images/bg-2.jpg" alt="Chicago" width="1100" height="500"></a>--}}
{{--                            </div>--}}
{{--                            <div class="carousel-item">--}}
{{--                                <img loading="lazy" src="/images/bg-1.jpg" alt="New York" width="1100" height="500">--}}
{{--                                <div class="carousel-caption">--}}
{{--                                    <h3>New York</h3>--}}
{{--                                    <p>We love the Big Apple!</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>

                <div class="row" >
                    <h2 class="col-12"><a class="text-warning" href="{{route('latest_movie')}}">Latest movie</a></h2>

                @foreach($new_movies as $movie )
                        <div class="col-md-4 col-lg-3  col-sm-6">

                            <a href="{{route('get_movie_by_slug',['slug' => $movie->slug , 'id' => $movie->id])}}" class="film-item    @unless($movie->is_free) film-vip-item @endunless ">

                                @if($movie->is_movie_series == 1)
                                    <div class="total-episode">{{$movie->episodes_count}}/ {{$movie->total_episode}} episodes</div>
                                @else
                                    <div class="ribbon">{{$movie->quality_label ?? "Full HD"}}</div>
                                @endif

                            @if($movie->is_free)
                                <div class="is-free">Free</div>
                                @else
                                    <div class="is-premium"><i class="fa fa-usd" aria-hidden="true"></i> Vip</div>
                                @endif
                                <img class="movie-img" loading="lazy" src="{{$movie->img}}" alt="">

                                <p>{{$movie->name}}</p>
{{--                                <p>free {{$movie->is_free}}</p>--}}
                                <span>{{$movie->en_name}}</span>
                            </a>
                        </div>
                    @endforeach




                </div>

                <div class="row" >
                    <h2 class="col-12"><a class="text-warning" href="{{route('recommended_movie')}}">Recommended for  you</a></h2>
                    @foreach($recommendedMovies as $recommended )
                        <div class="col-md-4 col-lg-3  col-sm-6">

                            <a href="{{route('get_movie_by_slug',['slug' => $recommended->slug , 'id' => $recommended->id])}}" class="film-item">
                                @if($recommended->is_movie_series == 1)
                                    <div class="total-episode">{{$movie->episodes_count}}/ {{$movie->total_episode}} episodes</div>
                                @else
                                    <div class="ribbon">full HD</div>
                                @endif



                                @if($recommended->is_free)
                                    <div class="is-free">Free</div>
                                @else
                                    <div class="is-premium"><i class="fa fa-usd" aria-hidden="true"></i> Vip</div>
                                @endif
                                <img loading="lazy" src="{{$recommended->img}}" alt="">

                                <p>{{$recommended->name}}</p>
                                                                <p>free {{$movie->is_free}}</p>
                                <span>{{$recommended->en_name}}</span>
                            </a>
                        </div>
                    @endforeach




                </div>
                <div class="row mb-5">
                    <h2 class="col-12"><a class="text-warning" href="">Featured actor</a></h2>
                    <div class="owl-carousel owl-theme " >

                        @foreach($featured_actors as $actor )
                            <div class="actor">
                                <a href="{{route('get_movie_by_actor' , ['slug' => $actor->slug, 'id' => $actor->id])}}" class="actor-link">
                                    <img src="{{$actor->img}}" class="actor-img  img-fluid" alt="">
                                    <p class="text-center text-warning">{{$actor->name}}</p>
                                </a>


                            </div>
                        @endforeach
                    </div>

                </div>



            </div>


            <!--  right content-->
            <div class="col-md-4  col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <div class="rating">
                            <h3>Most viewed</h3>
                            <ul class="list-rating">
                                @foreach($mostViewedMovies as $mostViewMovie)
                                    <li>

                                        <a class="img-link"  href="{{route('get_movie_by_slug',['slug' => $mostViewMovie->slug , 'id' => $mostViewMovie->id])}}">
                                            <img loading="lazy" class="owl-lazy small-img" src="{{$mostViewMovie->img}}" alt="">
                                            <div class="name-rating">
                                                <div class="big-name">{{$mostViewMovie->name}}</div>
                                                <div class="small-name">
                                                    {{$mostViewMovie->name}}
                                                </div>
                                                <div class="view-count"><i class="bi-eye">{{number_format($mostViewMovie->view_count)}}</i> Views
                                                </div>

                                            </div>
                                        </a>



                                    </li>
                                @endforeach


                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>


@endsection

@section('custom_js')
            <script>
                $(document).ready(function(){
                    var owl = $('.owl-carousel');

                    owl.owlCarousel({
                        items:4,
                        lazyLoad: true,
                        loop:true,
                        margin:40,
                        autoplay:true,
                        // autoWidth: true,
                        // autoHeight:true,
                        autoplayTimeout:800,
                        autoplayHoverPause:true,
                        nav: true,
                        navText:[`<div class='nav-btn prev-slide'><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                        </div>`,`<div class='nav-btn next-slide'><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></div>`],
                        responsiveClass:true,
                        responsive:{
                            0:{
                                items:2,
                                nav:true
                            },
                            600:{
                                items:3,
                                nav:false
                            },
                            1000:{
                                items:5,
                                nav:true,
                                loop:true,
                                navText:[`<div class='nav-btn prev-slide'><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                        </div>`,`<div class='nav-btn next-slide'><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></div>`],
                            }
                        }
                    });

                });
            </script>
@endsection
