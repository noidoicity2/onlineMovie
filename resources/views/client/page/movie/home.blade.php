@extends('client.layout.mainLayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-sm-12">
                <div class="slider">
                    <div id="demo" class="carousel slide" data-ride="carousel">
                        <ul class="carousel-indicators">
                            <li data-target="#demo" data-slide-to="0" class="active"></li>
                            <li data-target="#demo" data-slide-to="1"></li>
                            <li data-target="#demo" data-slide-to="2"></li>
                        </ul>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img loading="lazy" src="/images/bg-3.jpg" alt="Los Angeles" width="1100" height="500">
                                <div class="carousel-caption">
                                    <h3>Los Angeles</h3>
                                    <p>We had such a great time in LA!</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img loading="lazy" src="/images/bg-2.jpg" alt="Chicago" width="1100" height="500">
                                <div class="carousel-caption">
                                    <h3>Chicago</h3>
                                    <p>Thank you, Chicago!</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img loading="lazy" src="/images/bg-1.jpg" alt="New York" width="1100" height="500">
                                <div class="carousel-caption">
                                    <h3>New York</h3>
                                    <p>We love the Big Apple!</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
                <h2>Newest Movie</h2>
                <div class="row" >
                    @foreach($new_movies as $movie )
                        <div class="col-md-4 col-lg-3  col-sm-6">

                            <a href="{{route('get_movie_by_slug',['slug' => $movie->slug , 'id' => $movie->id])}}" class="film-item">
                                <div class="ribbon">full HD</div>
                                @if($movie->is_free)
                                <div class="is-free">Free</div>
                                @else
                                    <div class="is-premium"><i class="fa fa-usd" aria-hidden="true"></i> Vip</div>
                                @endif
                                <img loading="lazy" src="{{$movie->img}}" alt="">

                                <p>{{$movie->name}}</p>
{{--                                <p>free {{$movie->is_free}}</p>--}}
                                <span>{{$movie->en_name}}</span>
                            </a>
                        </div>
                    @endforeach




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
                                            <img loading="lazy" class="small-img" src="{{$mostViewMovie->img}}" alt="">
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
