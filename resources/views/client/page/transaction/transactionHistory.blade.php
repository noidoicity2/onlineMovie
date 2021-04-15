@extends("client.layout.mainLayout")

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h2 class="mt-5">Transaction history</h2>
{{--                <ol class="breadcrumb mb-4">--}}
{{--                    <li class="breadcrumb-item"><a href="index.html">Transaction History</a></li>--}}
{{--                    <li class="breadcrumb-item active">Tables</li>--}}
{{--                </ol>--}}

                <div class="bg-dark mb-4">
                    <div class="card-header font-weight-bold text-light">
                        <i class="fas fa-table mr-1"></i>
                       Transaction history
                    </div>


                            <table class="table table-bordered table-dark" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Membership name</th>
                                    <th>Created at</th>
                                    <th>Status</th>

                                </tr>
                                </thead>

                                <tbody>

                                @if(isset($transactions))
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>{{$transaction->id}}</td>
                                            <td>{{$transaction->membership->name}}</td>
                                            <td>{{$transaction->created_at}}</td>
                                            <td>{{$transaction->status}}</td>

                                        </tr>
                                    @endforeach
                                @else

                                @endif



                                </tbody>

                            </table>
                            {{$transactions->links()}}



                    </div>
                </div>


        </main>

    </div>

@endsection
@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable( {
                "paging":   false,

                "info":     false
            } );
        } );
    </script>
@endsection
