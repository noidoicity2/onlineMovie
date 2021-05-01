@extends("admin.layout.mainLayout")
@section('content')


    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Transaction statistic</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>



                <div class="row">
                   <div class="col-12">
                       <form class="form-inline" action="">
                           <div class="form-group mb-2 mr-2">
                               <label for="start_date" class="">From</label>
                               <input type="date" value="{{$from_date->format('Y-m-d') ?? Request::get('from_date')}}" id="from_date" class="form-control" name="from_date" >
                           </div>
                           <div class="form-group mb-2">
                               <label for="start_date" class="">to</label>
                               <input type="date" value="{{$to_date->format('Y-m-d') ?? Request::get('to_date')}}" id="to_date" class="form-control" name="to_date" >
                           </div>
                           <button type="submit" class="btn btn-primary mb-2">Generate statistic</button>
                       </form>
                   </div>

                </div>

                <div class="row">
                    <div class="col-6">
                        <div id="myBarChart" style="height: 500px; max-width: 100%; "></div>
                    </div>
                    <div class="col-6">
                        <div id="successTransactionChart" style="height: 500px; max-width: 100%; "></div>
                    </div>


                </div>
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table mr-1"></i>
                                        Transaction
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>User</th>
                                                    <th>Membership</th>
                                                    <th>number of day</th>
                                                    <th>total amount</th>
                                                    <th>status</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th>id</th>
                                                    <th>User</th>
                                                    <th>Membership</th>
                                                    <th>number of day</th>
                                                    <th>total amount</th>
                                                    <th>status</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                @foreach($transactions as $transaction)
                                                    <tr>
                                                        <td>{{$transaction->id}}</td>
                                                        <td>{{$transaction->user->name}} #{{$transaction->user->id}}</td>
                                                        <td>{{$transaction->membership->name}}</td>
                                                        <td>{{$transaction->membership->number_of_day}}</td>
                                                        <td>{{$transaction->total_amount}}</td>
                                                        @switch($transaction->status)

                                                            @case("success")
                                                            <td class="alert alert-success">{{$transaction->status}}</td>
                                                            @break
                                                            @case("pending")
                                                            <td class="alert alert-primary">{{$transaction->status}}</td>
                                                            @break

                                                            @case("unsuccessfully")
                                                            <td class="alert alert-warning">{{$transaction->status}}</td>
                                                            @break

                                                            @default
                                                            <td class="alert alert-danger">{{$transaction->status}}</td>

                                                        @endswitch

                                                    </tr>
                                                @endforeach




                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>



                <div class="row">
                    <div class="col-12">
                        {{--                            <span class="text-info m-2">Failed transaction: {{$failed_count}}</span>--}}
                        @if(isset($success_count))
{{--                            <h5 class="ml-3 text-danger">Failed transaction: {{$failed_count}}</h5>--}}
                            <h5 class="ml-3 text-primary">Successful transaction: {{$success_count}}</h5>
                            <h5 class="ml-3 text-danger">Total Revenue: {{number_format($total_revenue) }} VND</h5>

                        @endif
                        {{--                            <h5 class="ml-3">Failed transaction: {{$failed_count}}</h5>--}}
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
@section('custom_js')
    <script src="/js/scripts.js"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>--}}
{{--    <script src="/assets/demo/chart-area-demo.js"></script>--}}
{{--    <script src="/assets/demo/chart-bar-demo.js"></script>--}}
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>

    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
{{--    <script src="/assets/demo/datatables-demo.js"></script>--}}

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                searching : false,
                // paging : false

            });
        });
    </script>

    <script>
        var options = {
            animationEnabled: true,
            title: {
                text: "Order chart"
            },
            data: [{
                type: "pie",
                startAngle: 270,
                showInLegend: "true",
                legendText: "{label}",
                indexLabel: "{label} ({y})",
                yValueFormatString:"#,##0.#"%"",
                dataPoints: [

                    { label: "success", y: {{$success_count ?? 0}}  },

                    { label: "unsuccessful", y: {{$unsuccessful_count ?? 0}} },

                ]
            }]
        };

        var option2 = {
            animationEnabled: true,
            title: {
                text: "Order chart"
            },
            data: [{
                type: "pie",
                startAngle: 270,
                showInLegend: "true",
                legendText: "{label}",
                indexLabel: "{label} ({y})",
                yValueFormatString:"#,##0.#"%"",
                dataPoints: @json($successTrans)
            }]
        };
        $("#myBarChart").CanvasJSChart(options);
        $("#successTransactionChart").CanvasJSChart(option2);
    </script>


@endsection

