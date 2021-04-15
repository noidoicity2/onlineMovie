@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h2 class="" style="margin-top: 50px">Found {{$movies->total()}} results with keyword {{$keyword}}</h2>

            <form class="form-group row mt-5 mb-3" action="{{route('filter')}}">
                <div class="form-inline form-group col-12">
                    <label class="text-warning mr-5" for="">Keyword</label>
                    <input name="name" type="text" class="form-control">
                </div>
                <div class="form-inline col-12">
                    <select class="mt-1 mr-2 form-control form-control-sm bg-dark text-light" name="order_by" aria-label="Default select example">
                        <option >order by</option>
                        <option value="name">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <select class="mt-1 mr-2 form-control  form-control-sm bg-dark text-light" name="category_id" aria-label="Default select example">
                        <option value="">Category</option>
                        @foreach($selectCategories as $category)
                            <option value="{{$category->id}}">{{substr($category->name , 0 ,10)}}</option>
                        @endforeach
                    </select>
                    <select class="mt-1 mr-2 form-control  form-control-sm bg-dark text-light"  name="country_id" aria-label="Default select example">
                        <option value="" >Country</option>
                        @foreach($selectCountries as $country)
                            <option value="{{$country->id}}">{{substr($country->name , 0 , 10)}}</option>
                        @endforeach
                    </select>
                    <select class="mt-1 mr-2 form-control  form-control-sm bg-dark text-light" name="is_on_cinema" aria-label="Default select example">
                        <option value="" >On cinema now</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>

                    </select>
                    <select class="mt-1 mr-2 form-control  form-control-sm bg-dark text-light" name="is_free" aria-label="Default select example">
                        <option value="" >Free or premium</option>
                        <option value="1">free</option>
                        <option value="0">premium</option>

                    </select>
                    <select class="mt-1 mr-2 form-control  form-control-sm bg-dark text-light" name="is_movie_series" aria-label="Default select example">
                        <option value="" >Is movie series</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>

                    </select>
                    <select class="mt-1 mr-2 form-control form-control-sm    bg-dark text-light" name="published_at" aria-label="Default select example">
                        <option value="" selected>Published year</option>
                        @for($i= 1990 ; $i < 2021 ; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor


                    </select>

                    <button class="mt-1 btn btn-success ">Filter Result</button>


                </div>
            </form>

        <div class="row">

            @foreach($movies as $movie )
                <div class="col-md-4 col-lg-3  col-sm-6">

                    <a href="{{route('get_movie_by_slug',['slug' => $movie->slug , 'id' => $movie->id])}}" class="film-item">
                        <div class="ribbon">full HD</div>
                        @if($movie->is_free)
                            <div class="is-free">Free</div>
                        @endif
                        <img loading="lazy" src="{{$movie->img}}" alt="">

                        <p>{{$movie->name}}</p>
                                                        <p>free {{$movie->is_free}}</p>
                        <span>{{$movie->en_name}}</span>
                    </a>
                </div>
            @endforeach

        </div>
    {{$movies->links('vendor.pagination.bootstrap-4')}}


@endsection
