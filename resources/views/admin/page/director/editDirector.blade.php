@extends("admin.layout.mainLayout")

@section("content")

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Edit Director</h1>

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
                        <form method="post" action="{{route("post_edit_director")}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$director->id}}">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputFirstname">Director name</label>
                                    <input type="text" class="form-control" value="{{$director->name}}" name="name" id="name" placeholder="Enter director name">
                                </div>

                                <div class="col-sm-6">
                                    <label for="inputLastname">Slug (seo)</label>
                                    <input type="text" class="form-control" name="slug" value="{{$director->slug}}" id="slug" placeholder="Enter slug (optional)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for=""Image></label>
                                <input type="file" id="img" onchange="previewFile(this)" name="img" class="form-control-file">
                                <img id="previewImg" src="{{$director->img}}" alt="">

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="inputAddressLine1">Description</label>
                                    <textarea name="description" id="description"   class="form-control" id="description" placeholder="Enter Description">{{$director->description}}</textarea>
                                </div>

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

@section('custom_js')

    <script>
        // preview image
        function previewFile(input){
            var file = $("#img").get(0).files[0];

            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
