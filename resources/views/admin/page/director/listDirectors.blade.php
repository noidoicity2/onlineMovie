@extends("admin.layout.mainLayout")

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">List Directors</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">List director</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        List director
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>image</th>
                                    <th>Description</th>
                                    <th>Slug</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>image</th>
                                    <th>Description</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @if(isset($directors))
                                    @foreach($directors as $director)
                                        <tr>
                                            <td>{{$director->id}}</td>
                                            <td>{{$director->name}}</td>
                                            <td><img style="height: 150px" src="{{$director->img}}" alt=""></td>
                                            <td>{{$director->description}}</td>
                                            <td>{{$director->slug}}</td>
                                            <td style="text-align: center">
                                                <button class="delete-btn btn btn-danger rounded-circle " ><i class="fa fa-trash"></i></button>
                                                <a href="{{route("edit_director", ['id'=> $director->id])}}" class="btn btn-info rounded-circle update-btn" ><i class="fa fa-pen"></i></a>
{{--                                                <button class="btn btn-primary rounded-circle" ><i class="fa fa-eye"></i></button>--}}
{{--                                                <button class="btn btn-info rounded-circle" ><i class="fa fa-pen"></i></button>--}}
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

@section('custom_js')
    <script>
        $(document).ready(function (){

            $(".delete-btn").click(function () {
                if(!confirm("are you sure")) return false;
                var id = $(this).parent().parent().children().eq(0).text();
                var csrf =  $('#csrf_field').val();



                $.ajax({
                    method: "POST",
                    url: "{{route('post_delete_director')}}",
                    dataType: "json",
                    data: {
                        'id': id,
                        '_token': csrf,

                    },
                    success: function (data) {
                        console.log(data);

                        if(data.success) {
                            alert(data.message);
                            location.reload();
                        }
                        else alert("Something went wrong ! Cannot delete director")


                    },
                    error: function(xhr, status, error){
                        let errorMessage = xhr.status + ': ' + xhr.statusText
                        alert('Error - ' + errorMessage);
                    }
                });

                // console.log(id);
            });

            $(".update-btn").click(function (){
                var id = $(this).parent().parent().children().eq(0).text();
            });


        });


    </script>
@endsection
