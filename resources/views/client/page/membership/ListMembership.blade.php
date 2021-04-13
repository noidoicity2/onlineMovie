@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h1 class="text-warning mt-5 ml-3">Become vip</h1>
        <div class="row mt-2 mb-5">

            @foreach($memberships as $membership)
                <div class="col-sm-4">
                    <div class="card bg-dark text-light mb-5 " style="">

                        <div class="card-body">
                            <h5 class="card-title">{{$membership->name}}</h5>
                            <p class="card-text">{{$membership->description}}</p>
                            <p class="card-subtitle">{{number_format($membership->price)}} VND/  <span class="text-danger"> {{$membership->number_of_day}} Day</span></p>
                            <a href="{{route('preview_purchase' , ['id'=> $membership->id , 'day'=>$membership->number_of_day])}}" class="btn btn-primary">Buy now</a>
                        </div>
                    </div>
                </div>

            @endforeach


        </div>


    </div>
@endsection
