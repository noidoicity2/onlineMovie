@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h2 class="" style="margin-top: 50px">Request Movie</h2>
        @if(session('message'))
            <p class="alert alert-primary mb-2">{{session('message')}}</p>
        @endif
            <form action="{{route('post_request_movie')}}" class="form-group ">
                @csrf
                <div class="form-group">
                    <label class="text-light font-weight-bolder">Movie name</label>
                    <input type="text" class="form-control" name="movie_name">
                </div>
                <div class="form-group">
                    <label class="text-light font-weight-bolder">Director</label>
                    <input type="text" class="form-control" name="director_name">
                </div>
                <button class="btn btn-lg btn-primary align-items-center" style="">Send</button>
            </form>

        <div class="row">



        </div>



@endsection

