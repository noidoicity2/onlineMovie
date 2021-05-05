@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h2 class="text-center" style="margin-top: 50px">{{$actor->name}} </h2>
        <div class="row mb-5">

{{--            <img class="col-4 rounded mx-auto d-block img-fluid" style="height: 400px" src="{{$actor->img}}" alt="">--}}

            <div class="col-12">
                <div class="overflow-auto mb-5 " style="max-height: 400px; " id="">
                    <div class="card card-body  " style="background-color: #081b27!important;">
                        {!!$actor->description !!}
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <h2 class="col-12"><a class="text-warning" href="">Film participation</a></h2>

            @foreach($movies as $movie )
                <div class="col-md-4 col-lg-3  col-sm-6">

                    <a href="{{route('get_movie_by_slug',['slug' => $movie->slug , 'id' => $movie->id])}}" class="film-item">
                        <div class="ribbon">full HD</div>
                        @if($movie->is_free)
                            <div class="is-free">Free</div>
                        @endif
                        <img loading="lazy" src="{{$movie->img}}" alt="">

                        <p>{{$movie->name}}</p>
                        {{--                                <p>free {{$movie->is_free}}</p>--}}
                        <span>{{$movie->en_name}}</span>
                    </a>
                </div>
            @endforeach

        </div>
    {{$movies->links('vendor.pagination.bootstrap-4')}}


@endsection
