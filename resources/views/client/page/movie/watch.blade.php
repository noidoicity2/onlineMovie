@extends('client.layout.mainLayout')
@section('content')
    <div class="container-fluid">
        <!--    <h1 class="movie-title">Movie title</h1>-->
        <div class=" content-wrapper">
            <div class="row content-overlay">
                <div class="col-12"></div>
            </div>


        </div>

        <div class="section-detail">
            <div class="row">
                <div class="col-12">
                    <h2>Nội dung phim</h2>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt debitis accusantium perspiciatis, dolorem in maxime placeat expedita! Consequuntur, rem sapiente. Repudiandae officiis eum reprehenderit sint harum. Minima explicabo natus nam!

                    </p>
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
                                <img loading="lazy" src="/images/6.jpg" alt="">

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
