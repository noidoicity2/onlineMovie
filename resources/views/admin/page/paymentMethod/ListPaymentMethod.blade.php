@extends("admin.layout.mainLayout")

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">List Payment method</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>
                {{--                <div class="card mb-4">--}}
                {{--                    <div class="card-body">--}}
                {{--                        DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the--}}
                {{--                        <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>--}}
                {{--                        .--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="row">--}}
                {{--                    <div class="col-12">--}}
                {{--                        <div class="alert alert-success success-action d-none">--}}
                {{--                            <strong>Success!</strong> You should <a href="#" class="alert-link">read this message</a>.--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Category table
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>image</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @if(isset($paymentMethods))
                                    @foreach($paymentMethods as $payment)
                                        <tr>
                                            <td>{{$payment->id}}</td>
                                            <td>{{$payment->name}}</td>
                                            <td>{{$payment->description}}</td>
                                            <td><img src="{{$payment->img}}" style="height: 100px" alt='{{$payment->name}}'> </td>
                                            <td style="text-align: center">
                                                <button class="btn btn-danger rounded-circle delete-btn" ><i class="fa fa-trash"></i></button>
                                                <a href="{{route("edit_payment_method", ['id'=> $payment->id])}}" class="btn btn-info rounded-circle update-btn" ><i class="fa fa-pen"></i></a>
                                                <button class="btn btn-primary rounded-circle" ><i class="fa fa-eye"></i></button>
                                                <button class="btn btn-info rounded-circle" ><i class="fa fa-pen"></i></button>
                                            </td>

                                        </tr>
                                    @endforeach
                                @else

                                @endif



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
