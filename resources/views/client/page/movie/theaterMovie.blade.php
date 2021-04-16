@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h2 class="" style="margin-top: 50px">In Theater</h2>
    </div>

    <div class="container scrolling-pagination">


            <div class="row ">

                @foreach($movies as $movie )
                    <div class="col-3">

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
                    {{$movies->links('vendor.pagination.bootstrap-4')}}
            </div>





@endsection

@section('custom_js')
            <script>
                $('ul.pagination').hide();
                $(function() {
                    $('.scrolling-pagination').jscroll({
                        autoTrigger: true,
                        padding: 0,
                        nextSelector: '.pagination li.active + li a',
                        contentSelector: 'div.scrolling-pagination',
                        callback: function() {
                            $('ul.pagination').remove();
                        }
                    });
                });
            </script>
@endsection
