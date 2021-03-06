<nav class="navbar fixed-top navbar-expand-lg navbar-light  fixed-top justify-content-lg-around" style="background-color: #0c2738">
    <div class="container-fluid">
        <a class="navbar-brand" href="/" style="font-size: 50px"><i class="fa fa-film" aria-hidden="true"></i>
            Emovie</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse item-nav" id="navbarResponsive">
            <form class="d-flex ml-auto search-form" action="{{route('search')}}">
                <!--        <label for="email">Email:</label>-->
                <input class="form-control mr-sm-2 search-input" name="name"  type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 search-btn" type="submit">Search</button>
            </form>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown ">
                    <a  class="nav-link dropdown-toggle" href="" id="navbarDropdownPortfolio" data-toggle="dropdown"  aria-expanded="false">
                        Countries
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="overflow: auto ; max-height: 500px" aria-labelledby="navbarDropdownPortfolio">
                        <a class="dropdown-item text-success"  style="" href="{{route('get_all_country)')}}">All Countries</a>
                        @foreach($navCountries as $country)
                            <a class="dropdown-item" href="{{route('get_movie_by_country' , ['slug' => $country->slug , 'id' => $country->id])}}">{{$country->name}}</a>
                        @endforeach
                        {{--                        <a class="dropdown-item" href="portfolio-1-col.html">1 Column Portfolio</a>--}}
                        {{--                        <a class="dropdown-item" href="portfolio-2-col.html">2 Column Portfolio</a>--}}
                        {{--                        <a class="dropdown-item" href="portfolio-3-col.html">3 Column Portfolio</a>--}}
                        {{--                        <a class="dropdown-item" href="portfolio-4-col.html">4 Column Portfolio</a>--}}
                        {{--                        <a class="dropdown-item" href="portfolio-item.html">Single Portfolio Item</a>--}}
                    </div>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{route('')}}">New movie</a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link" href="{{route('get_theater_movie')}}">In theater</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('get_movie_series')}}">Movie series</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('top_rate_movie')}}">Top Rating</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                        @foreach($navCategories as $category)
                            <a class="dropdown-item" href="{{route('get_movie_by_category' , ['slug'=>$category->slug, 'id' => $category->id])}}">{{$category->name}}</a>
                        @endforeach

                    </div>
                </li>
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        Blog--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">--}}
{{--                        <a class="dropdown-item" href="blog-home-1.html">Blog Home 1</a>--}}
{{--                        <a class="dropdown-item" href="blog-home-2.html">Blog Home 2</a>--}}
{{--                        <a class="dropdown-item" href="blog-post.html">Blog Post</a>--}}
{{--                    </div>--}}
{{--                </li>--}}
                @unless(Auth::user())
                    <li class="nav-item " >
                        <a class="nav-link  font-weight-bold" href="{{route('login')}}"><i class="bi bi-box-arrow-in-right"></i>
                            Login</a>
                    </li>
                    <li class="nav-item"  >
                        <a class="nav-link font-weight-bold text-light bg-success" href="{{route('register')}}"><i class="bi bi-box-arrow-in-right"></i>
                            Sign Up</a>
                    </li>
                @endunless

                @auth
                    @if(Auth::user()->is_vip ==0)
                        <li class="nav-item">
                            <a class="nav-link bg-danger rounded" href="{{route('buy_vip')}}">Buy Vip</a>
                        </li>


                    @endif


                <li class="nav-item dropdown avatar-area">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img loading="lazy" class="avatar" src="/images/avatar.JPG" alt="">

                            {{Auth::user()->name}}  @if(Auth::user()->is_vip ==1)  <span class="text-danger">(Vip)</span> @endif


                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPages">
                        @if(Auth::user()->is_vip ==1)
                            <a class="dropdown-item bg-warning" href="{{route('buy_vip')}}">Upgrade your membership</a>
                        @endif
                            <a class="dropdown-item" href="{{route('your_membership')}}">Your Membership</a>
                            <a class="dropdown-item" href="{{route('favorite_movie')}}">Your favorite</a>
                            <a class="dropdown-item" href="{{route('get_bookmark_movie')}}">Book-marked movie</a>
                            <a class="dropdown-item" href="{{route('transaction_history')}}">Your transactions</a>
{{--                            <a class="dropdown-item" href="{{route('request_movie')}}">Request Movie</a>--}}
{{--                            <a class="dropdown-item" href="404.html">404</a>--}}
                            <a class="dropdown-item" href="{{route('logout')}}">Log out</a>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
