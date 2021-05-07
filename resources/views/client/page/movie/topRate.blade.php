@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h2 class="" style="margin-top: 50px">Top  Rated Movie</h2>

        <?php $count = 1 ?>
            @foreach($movies as $movie)
            <div class="row mb-5">

                <div class="col-md-4 ">
                    <img style="height: 300px" src="{{$movie->img}}" alt="">
                </div>
                <div class="col-md-8">
                    <h2><a href="{{route('get_movie_by_slug' , ['slug' =>$movie->slug , 'id' =>$movie->id])}}">Top {{$count}}</a></h2>
                    <h3 class="text-light">{{$movie->name}}</h3>
                        <p class="text-warning"> <i class="fa fa-star"></i> {{number_format($movie->rating ,1) }} /{{$movie->movie_ratings_count}} reviews</p>

                </div>
            </div>
    <?php $count++ ?>
            @endforeach




@endsection

