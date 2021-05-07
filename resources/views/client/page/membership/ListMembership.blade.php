@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h1 class="text-warning mt-5 ml-3">Become vip</h1>
        <div class="row mt-2 mb-5">

            @foreach($memberships as $membership)
                <div class="col-sm-4">
                    <div class="card  text-light mb-5 "  style="background-color: #000000">

                        <div class="card-body" >
                            <div style="max-height: 300px">
                                <h5 class="card-title text-center font-weight-bolder text-light " style="font-size: 25px; text-transform: uppercase">{{$membership->name}}</h5>
                                <p class="card-text text-center">{{$membership->description}}</p>

                            </div>
                            <p class="mt-5" style="font-size: smaller">Categories included:
                                @foreach($membership->categories as $category)
                                    <a href="">{{$category->name}}</a>
                                @endforeach

                            </p>







                            <p class="card-subtitle text-center">{{number_format($membership->price)}} VND/  <span class="text-danger"> {{$membership->number_of_day}} Day</span></p>
                            <a href="{{route('preview_purchase' , ['id'=> $membership->id , 'day'=>$membership->number_of_day])}}" class="btn btn-danger mt-2" style="width: 100% ;">Buy now</a>
                        </div>
                    </div>
                </div>

            @endforeach


        </div>


    </div>
@endsection
