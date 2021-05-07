@extends("admin.layout.mainLayout")

@section("content")

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Add Actor</h1>
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
                        <form method="post" action="{{route("post_add_user")}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputFirstname">User name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name">
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputFirstname">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter  email">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="inputFirstname">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter  email">
                            </div>

                            <div class="form-group">
                                <label for="inputFirstname">role</label>
                                <select class="form-control" name="role_id" id="">
                                    <option value="1">admin</option>
                                    <option value="2">customer</option>
                                </select>
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
        $('#description').summernote({
            toolbar: [

                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert' , ['picture' , 'link' , 'video' , 'table']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ] ,
            lang: 'en',
            onImageUpload: function(files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
            }

        });

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
