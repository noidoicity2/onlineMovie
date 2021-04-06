@extends('client.layout.mainLayout')

@section('content')
<div class="container ">
    <h2 class="mt-5 ">List countries</h2>
    <div class="row">

        @foreach($listCountries as $country)
            <div class="col-3 col-md-2  mb-2 ">
                <a href="{{route('get_movie_by_country' ,['slug'=> $country->slug , 'id' =>$country->id])}}" class="float-left">{{$country->name}}</a>
            </div>
        @endforeach



    </div>
    {{$listCountries->links('vendor.pagination.bootstrap-4')}}

</div>
@endsection
