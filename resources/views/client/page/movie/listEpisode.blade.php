@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h2 class="" style="margin-top: 50px">List Episode</h2>
        <div class="row">

            @foreach($episodes as $episode )
                <a href="{{route('watch_episode' , ['slug' => $episode->slug , 'id' => $episode->id])}}" class="btn btn-secondary">{{$episode->name}}</a>
            @endforeach

        </div>
    {{$episodes->links('vendor.pagination.bootstrap-4')}}


@endsection

