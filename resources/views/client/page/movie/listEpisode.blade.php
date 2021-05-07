@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h2 class="" style="margin-top: 50px">List Episode</h2>
        <div class="row mb-lg-5">

            @foreach($episodes as $episode )
                <a  href="{{route('watch_episode' , ['slug' => $episode->slug , 'id' => $episode->id])}}" class="col-md-1 col-sm-12 btn btn-outline-warning align-middle mr-2 mb-2 text-capitalize" >{{$episode->name}}</a>
            @endforeach

        </div>
    </div>



@endsection

