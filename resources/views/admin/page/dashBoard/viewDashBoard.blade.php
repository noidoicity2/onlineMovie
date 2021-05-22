@extends("admin.layout.mainLayout")
@section('content')


    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <p style="font-size: 20px" class="text-light font-weight-bolder mt-3 ml-3">{{number_format($totalRevenue)}}  <span>VND</span></p>
                            <div class="card-body font-weight-bolder" style="font-size: 30px ">Total revenue</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
{{--                                <a class="small text-white stretched-link" href="#">View Details</a>--}}
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <p style="font-size: 20px" class="text-light font-weight-bolder mt-3 ml-3">{{$totalMovie}}  <span>Movies</span></p>
                            <div class="card-body font-weight-bolder" style="font-size: 30px ">Total Movie</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
{{--                                <a class="small text-white stretched-link" href="#">View Details</a>--}}
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <p style="font-size: 20px" class="text-light font-weight-bolder mt-3 ml-3">{{$totalUser}}  <span>Users</span></p>
                            <div class="card-body font-weight-bolder" style="font-size: 30px ">Total User</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
{{--                                <a class="small text-white stretched-link" href="#">View Details</a>--}}
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <p style="font-size: 20px" class="text-light font-weight-bolder mt-3 ml-3">{{$totalCategory}}  <span>Categories</span></p>
                            <div class="card-body font-weight-bolder" style="font-size: 30px ">Total Category</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
{{--                                <a class="small text-white stretched-link" href="#">View Details</a>--}}
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="myBarChart" style="height: 500px; max-width: 100%; "></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

    <script>
        var options = {
            animationEnabled: true,
            zoomEnabled: true,
            title:{
                text: "Revenue in  30 day"
            },
            axisX: {
                // valueFormatString: "MMM"
            },
            axisY: {
                title: "VND",

                includeZero: false
            },
            data: [{
                // yValueFormatString: "$#,###",
                // xValueFormatString: "MMMM",
                type: "spline",
                dataPoints: @json($chart_data)
            }]
        };
        $("#myBarChart").CanvasJSChart(options);
    </script>

@endsection

