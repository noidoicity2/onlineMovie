@extends("admin.layout.mainLayout")

@section("content")

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Add Slider</h1>
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
                        <form method="post" action="{{route("post_add_slider")}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group ">
                                <div class="form-group">
                                    <label for="inputFirstname">slider name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name">
                                </div>
{{--                                <div class="col-sm-6">--}}
{{--                                    <label for="description">Slug (seo)</label>--}}
{{--                                    <input type="text" class="form-control" name="description" id="description" placeholder="Enter slug (optional)">--}}
{{--                                </div>--}}
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="inputAddressLine1">Description</label>
                                    <textarea name="description" id="description" class="form-control" id="description" placeholder="Enter Description">

                                    </textarea>
                                </div>

                            </div>

                            <div class="form-group" >
                                <label for="">image </label>
                                <input class="form-control-file" type="file" name="image_url">
                            </div>

                            <div class="form-group" >
                                <label for="">Display order </label>
                                <input class="form-control" type="text" name="display_order">
                            </div>

                            <div class="form-group" >
                                <label for="">Target movie </label>
                                <input class="form-control" type="text" name="movie_id">
                            </div>

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
