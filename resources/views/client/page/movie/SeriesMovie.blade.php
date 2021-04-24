@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h2 class="" style="margin-top: 50px">Movie series</h2>
        <div class="row">

            @foreach($movies as $movie )
                <div class="col-md-4 col-lg-3  col-sm-6">

                    <a href="{{route('get_movie_by_slug',['slug' => $movie->slug , 'id' => $movie->id])}}" class="film-item">
                        @if($movie->is_movie_series == 1)
                            <div class="ribbon">{{$movie->episodes_count}}/ {{$movie->total_episode}} episodes</div>
                        @else
                            <div class="ribbon">full HD</div>
                        @endif
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

