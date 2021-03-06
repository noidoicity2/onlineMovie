<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{route('dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
{{--                <div class="sb-sidenav-menu-heading">Interface</div>--}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
{{--                category--}}
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('add_category')}}">Add new</a>
                        <a class="nav-link" href="{{route('list_category')}}">All categories</a>
                    </nav>
                </div>
{{--                end category--}}

                {{--                <div class="sb-sidenav-menu-heading">Interface</div>--}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#director_nav" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Director
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                {{--                director--}}
                <div class="collapse" id="director_nav" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('add_director')}}">Add new</a>
                        <a class="nav-link" href="{{route('list_director')}}">All director</a>
                    </nav>
                </div>
                {{--                end director--}}
{{--actor--}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#actor_nav" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Actor
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse" id="actor_nav" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('add_actor')}}">Add new</a>
                        <a class="nav-link" href="{{route('list_actor')}}">All actor</a>
                    </nav>
                </div>
                {{--                end actor--}}

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#statistic" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Statistic
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                {{--                statistic--}}
                <div class="collapse" id="statistic" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('transaction_statistic')}}">Transaction statistic</a>
                        <a class="nav-link" href="{{route('movie_statistic')}}">Movie statistic</a>
                        <a class="nav-link" href="{{route('revenue_statistic')}}">Revenue statistic</a>

                    </nav>
                </div>


                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user-nav" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    User
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                {{--                statistic--}}
                <div class="collapse" id="user-nav" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('add_user')}}">Add user</a>
                        <a class="nav-link" href="{{route('list_user')}}">All user</a>
                    </nav>
                </div>


                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#movie-menu" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                    Movie
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="movie-menu" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('add_movie')}}">Add new movie</a>
                        <a class="nav-link" href="{{route('list_movie')}}">All movie</a>
                    </nav>
                </div>
                {{--                end Movie--}}


                {{--                Country--}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#country-menu" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas  fa-globe"></i></div>
                    Country
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="country-menu" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('add_movie')}}">Add new movie</a>
                        <a class="nav-link" href="{{route('list_category')}}">All movie</a>
                    </nav>
                </div>
                {{--                end Country--}}



                {{--                slider--}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#slider-menu" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                    Slider
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="slider-menu" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('add_slider')}}">Add new slider</a>
{{--                        <a class="nav-link" href="{{route('N')}}">All movie</a>--}}
                    </nav>
                </div>
                {{--                end slider--}}


                {{--                membership--}}
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#membership-menu" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-credit-card"></i></div>
                    Membership
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="membership-menu" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('add_membership')}}">Add membership</a>
                        <a class="nav-link" href="{{route('list_membership')}}">list membership</a>
                    </nav>
                </div>
                {{--             membership--}}


            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            MR Dat
        </div>
    </nav>
</div>
