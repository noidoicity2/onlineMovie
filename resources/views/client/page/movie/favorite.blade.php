@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h2 class="" style="margin-top: 50px">Your favorite Movie</h2>
        <div class="row">

            @foreach($favorite_items as $item )
                <div class="col-md-4 col-lg-3  col-sm-6">

                    <a href="{{route('get_movie_by_slug',['slug' => $item->movie->slug , 'id' => $item->movie->id])}}" class="film-item">
                        <div class="ribbon">full HD</div>
                        @if($item->movie->is_free)
                            <div class="is-free">Free</div>
                        @endif
                        <img loading="lazy" src="{{$item->movie->img}}" alt="">

                        <p>{{$item->movie->name}}</p>
                        {{--                                <p>free {{$item->movie->is_free}}</p>--}}
                        <span>{{$item->movie->en_name}}</span>
                    </a>
                </div>
            @endforeach

        </div>
    {{$favorite_items->links('vendor.pagination.bootstrap-4')}}


@endsection
