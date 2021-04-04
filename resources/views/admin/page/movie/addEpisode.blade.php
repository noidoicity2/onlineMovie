@extends('admin.layout.mainLayout')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Add Episode for movie {{$movie->name}}</h1>
                {{--                <ol class="breadcrumb mb-4">--}}
                {{--                    <li class="breadcrumb-item active">Add new category</li>--}}
                {{--                </ol>--}}
                <div class="col-xl-12 col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="col-xl-12 col-md-12">
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <form action="{{route('post_add_episode')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$movie->id}}">
                            <div class="form-container">
                                <div class="form-group" id="form-container">
                                    <label for="name">Episode Name</label>
                                    <input type="name" class="form-control mb-2" name="episode[][name]" id="" placeholder="Enter movie name">
                                    <input type="file" class="form-control-file" name="episode[][url]" id="" placeholder="Enter movie name">
{{--                                    <input type="file" name="file">--}}
                                    <hr>
                                </div>
                            </div>

                            <button id="addEpisode" class="btn btn-success  float-left mr-2"><i class="fa fa-plus"></i> add episode</button>




                            <button type="submit" class="btn btn-primary px-lg-5 float-left">Save</button>
                        </form>
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
         $count = 1;
        $('#addEpisode').click(function (e){
            if($count>= 10){
                e.preventDefault();
                alert('Error. You can upload maximum 10 file ');
                return;
            }
            e.preventDefault();
            $htm = ` <label for="name">Episode Name</label>
                     <input type="name" class="form-control mb-2" name="episode[][name]" id="" placeholder="Enter movie name">
                     <input type="file" class="form-control-file" name="episode[][url]" id="" placeholder="Enter movie name">
                     <hr>`;
            $('#form-container').append($htm);
            $count++;

        });
    </script>
@endsection
