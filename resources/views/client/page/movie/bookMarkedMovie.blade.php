@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h2 class="" style="margin-top: 50px">Your book-marked movie</h2>
        <div class="row">

            @foreach($bookmarks as $item )
                <div class="col-md-4 col-lg-3  col-sm-6">

                    <a href="{{route('get_movie_by_slug',['slug' => $item->movie->slug , 'id' => $item->movie->id])}}" class="film-item">

                        @if($item->movie->is_movie_series == 1)
                            <div class="total-episode">{{$item->episodes_count}}/ {{$item->movie->total_episode}} episodes</div>
                        @else
                            <div class="ribbon">full HD</div>
                        @endif

                        @if($item->movie->is_free)
                            <div class="is-free">Free</div>
                        @endif
                        <img loading="lazy" src="{{$item->movie->img}}" alt="">

                        <p>{{$item->movie->name}}</p>
                        {{--                                <p>free {{$item->movie->is_free}}</p>--}}
                        <span>{{$item->movie->en_name}}</span>
                        <div class="playing" id="" style="width: {{$item->position/($item->movie->duration*60)}}%;  "></div>

                    </a>
                </div>
            @endforeach

        </div>
    {{$bookmarks->links('vendor.pagination.bootstrap-4')}}


@endsection
