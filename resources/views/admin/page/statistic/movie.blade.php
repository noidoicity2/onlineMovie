@extends("admin.layout.mainLayout")
@section('content')


    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Movie statistic</h1>
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
                    <div class="col-12">
                        <div id="myBarChart" style="height: 500px; max-width: 100%; "></div>
                    </div>



                </div>
                <div class="row">
                    <h2 class="ml-3 alert-success">Total View :  <span class="">{{$total_view}}</span></h2>
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
                                    <th>Movie</th>
                                    <th>image</th>
                                    <th>view</th>
                                    <th>Favorite count</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th>Movie</th>
                                    <th>image</th>
                                    <th>view</th>
                                    <th>Favorite count</th>

                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($movies as $movie)
                                    <tr>
                                        <td>{{$movie->id}}</td>
                                        <td>{{$movie->name}} </td>
                                        <td><img src="{{$movie->img}}" style="height: 100px" alt=""> </td>
                                        <td><a href="{{route('movie_statistic_detail' , ['id' => $movie->id])}}">{{$movie->movie_views_count}}</a> </td>
                                        <td>{{$movie->favorite_movies_count}}</td>

                                    </tr>
                                @endforeach




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
            title:{
                text: "Total views"
            },
            axisX: {
                // valueFormatString: "MMM"
            },
            axisY: {
                title: "Views",

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

