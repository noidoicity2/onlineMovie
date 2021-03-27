<nav class="navbar fixed-top navbar-expand-lg navbar-light  fixed-top justify-content-lg-around">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html">Emovie</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse item-nav" id="navbarResponsive">
            <form class="d-flex ml-auto search-form" action="/action_page.php">
                <!--        <label for="email">Email:</label>-->
                <input class="form-control mr-sm-2 search-input"  type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0 search-btn" type="submit">Search</button>
            </form>

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="about.html">New movie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">New movie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">New movie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">Movie series</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                        @foreach($categories as $category)
                            <a class="dropdown-item" href="portfolio-1-col.html">{{$category->name}}</a>
                        @endforeach
{{--                        <a class="dropdown-item" href="portfolio-1-col.html">1 Column Portfolio</a>--}}
{{--                        <a class="dropdown-item" href="portfolio-2-col.html">2 Column Portfolio</a>--}}
{{--                        <a class="dropdown-item" href="portfolio-3-col.html">3 Column Portfolio</a>--}}
{{--                        <a class="dropdown-item" href="portfolio-4-col.html">4 Column Portfolio</a>--}}
{{--                        <a class="dropdown-item" href="portfolio-item.html">Single Portfolio Item</a>--}}
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Blog
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                        <a class="dropdown-item" href="blog-home-1.html">Blog Home 1</a>
                        <a class="dropdown-item" href="blog-home-2.html">Blog Home 2</a>
                        <a class="dropdown-item" href="blog-post.html">Blog Post</a>
                    </div>
                </li>
                <li class="nav-item dropdown avatar-area">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img loading="lazy" class="avatar" src="images/avatar.JPG" alt="">
                        @auth
                            {{Auth::user()->name}}
                        @endauth
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPages">
                        <a class="dropdown-item" href="full-width.html">Full Width Page</a>
                        <a class="dropdown-item" href="sidebar.html">Sidebar Page</a>
                        <a class="dropdown-item" href="faq.html">FAQ</a>
                        <a class="dropdown-item" href="404.html">404</a>
                        <a class="dropdown-item" href="{{route('logout')}}">Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
