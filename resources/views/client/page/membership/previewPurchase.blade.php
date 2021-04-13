@extends('client.layout.mainLayout')

@section('content')
    <div class="container">
        <h1 class="text-success  text-center mt-5 ml-3" style="text-transform: uppercase">Become vip member</h1>
{{--        <div class="row mt-2 mb-5">--}}


            <div class="card text-center mb-5">
                <div class="card-header bg-dark text-light">
                   {{$membership->name}}
                </div>
                <div class="card-body ">
                    <h5 class="card-title "> {{$membership->name}}</h5>
                    <p class="card-text">{{$membership->description}}</p>
{{--                    <a href="#" class="btn btn-primary">Go somewhere</a>--}}
                </div>


                <div class="card-footer text-muted">
                {{number_format($membership->price) }} VND  / {{$membership->number_of_day}} days
                </div>
                <div class="text-center ">
                    <form action="{{route('create_payment')}}" class=" ml-2 " style="" method="post">
                        <div class="form-inline ">
                            @csrf
                            <input type="hidden" name="membership_id" value="{{$membership->id}}">
                            @if($membership->number_of_day ==1)
                                <label class="text-secondary" for="">Enter number of day</label>
                                <input class="form-control" name="number_of_day" type="text">
                            @endif




                        </div>

                        <button class="float-right btn btn-primary mr-5">Purchase</button>
                        <p class="text-center  font-weight-bold float-left ml-4" style="font-size: 1.5rem" for="">Total <span class="text-danger" id="total">        {{number_format($membership->price) }} </span>VND</p>
                    </form>
                </div>
            </div>
        <div class="row">

        </div>



{{--        </div>--}}


    </div>
@endsection
