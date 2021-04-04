@extends('client.layout.mainLayout')
@section('content')
    <div class="container-fluid">
        <!--    <h1 class="movie-title">Movie title</h1>-->
        <div class=" content-wrapper" @if($movie->bg_img) style="background-image: url({{$movie->bg_img}});" @endif>
            <div class="row content-overlay">
                <div class="col-12 col-sm-6 img-area d-flex flex-column ">
                    <div class="img-left-container d-flex justify-content-center">
                        <img class="film-img" src="{{$movie->img}}" alt="">
                    </div>

                    <div class="group-btn d-flex mt-3" >
                        <a href="{{route('watch_movie',['slug' => $movie->slug , 'id' => $movie->id])}}" type="button" style="line-height: 50px ; font-size: 30px" class="btn bg-danger text-light  m-2 w-25 "><i class="bi bi-play-fill"></i>
                            Watch</a>
                        <a type="button" class="btn bg-secondary text-light m-2 w-25"><i class="bi bi-card-list  "></i>
                            Secondary</a>
                        <a type="button" class="btn bg-primary text-light m-2 w-25 "><i class="bi bi-eye-fill "></i>
                            Secondary</a>
                    </div>

                </div>

                <div class="col-12 col-sm-6 right-detail">
                    <h1 class="film-title">{{$movie->name}}</h1>
                    <h2 class="en-title">{{$movie->en_name}}</h2>
                    <p class="detail-item">{{$movie->director_id}}</p>
                    <p class="detail-item">Quality:</p>
                    <p class="detail-item">Actor :</p>
                    <p class="detail-item">Genre:</p>
                    <p class="detail-item">Duration:</p>
                    <p class="detail-item">Nation:</p>
                    <p class="detail-item">View count:</p>
                    <p class="detail-item">Publish date: {{$movie->created_at}}</p>
                    <p class="detail-item">Total Episode: {{$movie->total_episode}}</p>
                    <p class="detail-item">List episode {{$movie->episodes->count()}}:</p>

                </div>
            </div>


        </div>

        <div class="section-detail">
            <div class="row">
                <div class="col-12">
                    <h2>Nội dung phim</h2>
                   {!!html_entity_decode($movie->description) !!}
                </div>
            </div>
        </div>


        <div class="section-related">


            <div class="row">
                <div class="col-md-8 col-sm-12">

                    <h2>Related movie</h2>
                    <div class="row">


                        <div class="col-md-4 col-lg-3  col-sm-6">

                            <a href="" class="film-item">
                                <div class="ribbon">full HD</div>
                                <div class="is-free">Free</div>
                                <img loading="lazy" src="{{$movie->img}}" alt="">

                                <p>Film name</p>
                                <span>Real naem</span>
                            </a>
                        </div>

                        <div class="col-md-4 col-lg-3 col-sm-6">

                            <a href="" class="film-item">
                                <div class="ribbon">full HD</div>
                                <div class="is-free">Free</div>
                                <img loading="lazy" src="/images/4.jpg" alt="">

                                <p>Film name</p>
                                <span>Real naem</span>
                            </a>
                        </div>


                        <div class="col-md-4 col-lg-3 col-sm-6">

                            <a href="" class="film-item">
                                <div class="ribbon">full HD</div>
                                <div class="is-free">Free</div>
                                <img loading="lazy" src="/images/5.jpg" alt="">

                                <p>Film name</p>
                                <span>Real naem</span>
                            </a>
                        </div>

                        <div class="col-md-4 col-lg-3 col-sm-6 ">

                            <a href="" class="film-item">
                                <div class="ribbon">full HD</div>
                                <div class="is-free">Free</div>
                                <img loading="lazy" src="/images/8.jpg" alt="">

                                <p>Film name</p>
                                <span>Real naem</span>
                            </a>
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
                                    <li>

                                        <a class="img-link" href="">
                                            <img loading="lazy" class="small-img" src="/images/13.jpg" alt="">
                                            <div class="name-rating">
                                                <div class="big-name">Big name</div>
                                                <div class="small-name">
                                                    small name
                                                </div>
                                                <div class="view-count"><i class="bi-eye">100.000.000</i> Views
                                                </div>

                                            </div>
                                        </a>


                                    </li>
                                    <li>

                                        <a class="img-link" href="">
                                            <img loading="lazy" class="small-img" src="/images/13.jpg" alt="">
                                            <div class="name-rating">
                                                <div class="big-name">Big name</div>
                                                <div class="small-name">
                                                    small name
                                                </div>
                                                <div class="view-count"><i class="bi-eye">100.000.000</i> Views
                                                </div>


                                            </div>
                                        </a>
                                    </li>
                                    <li>

                                        <a class="img-link" href="">
                                            <img loading="lazy" class="small-img" src="/images/13.jpg" alt="">
                                            <div class="name-rating">
                                                <div class="big-name">Big name</div>
                                                <div class="small-name">
                                                    small name
                                                </div>
                                                <div class="view-count"><i class="bi-eye">100.000.000</i> Views
                                                </div>


                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Portfolio Section -->


    </div>
@endsection
