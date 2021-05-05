
@extends("admin.layout.mainLayout")

@section("content")

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Add Movie</h1>
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
                    @if(session('error'))
                        <div class="alert alert-warning">
                            {{session('error')}}
                        </div>
                    @endif

                </div>
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <form id="AddMovieForm" action="{{route('post_edit_movie')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" >Movie Name</label>
                                <input type="text" class="form-control" required value="{{$movie->name}}" name="name" id="name" placeholder="Enter movie name">
                            </div>
                            <div class="form-group">
                                <label for="en_name">Real Name</label>
                                <input type="text" class="form-control" required name="en_name" value="{{$movie->en_name}}" id="en_name" placeholder="Enter real name">
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration(minutes)</label>
                                <input type="text" required class="form-control" value="{{$movie->duration}}" name="duration" id="duration" placeholder="Enter duration in minutes">
                            </div>
                            <div class="form-group">
                                <label for="country">Director</label>
                                <select class="single-select form-control choices__input"  data-trigger=""  name="director_id" id="director_id" placeholder="This is a search placeholder" hidden="" tabindex="-1" data-choice="active">
                                    @foreach($directors as $director)
                                        <option @if($movie->director_id == $director->id) selected @endif value="{{$director->id}}">{{$director->name}}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="published_at">Publish at</label>
                                <input type="datetime-local" class="form-control" value="{{date("Y-m-d\TH:i:s", strtotime($movie->published_at))}}" name="published_at" id="published_at" placeholder="Enter director name">
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-6">
                                    <label for="img">Choose image</label>
                                    <input type="file" class="form-control-file" value="{{old('img')}}" onchange="previewImg(this)" name="img" id="img">
                                    <img style="height: 500px" id="preview-img" src="{{$movie->img}}" alt="">
                                </div>
                                <div class="form-group col-6">
                                    <label for="bg_img">Choose back ground image</label>
                                    <input type="file" onchange="previewBg(this)" class="form-control-file" name="bg_img" id="bg_img">
                                    <img style="height: 500px" id="preview-bg" src="{{$movie->bg_img}}" alt="">
                                </div>
                                <div class="form-group col-12">
                                    <label for="source_url">Choose video source</label>
                                    <input  type="file" class="form-control-file" name="source_url" id="source_url">

                                </div>

                            </div>
                            <div class="form-group">
                                <label for="is_free">For free user</label>
                                <input name="is_free" id="is_free" type="checkbox">
                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <select class="form-control" name="country_id" id="country">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug" placeholder="Enter slug for SEO">
                            </div>
                            <div class="form-group">
                                <label for="imdb">IMDB</label>
                                <input type="number" class="form-control" name="imdb" id="slug" placeholder="Enter IMDB">
                            </div>

                            <div class="form-group">
                                <label for="info">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>

                            </div>
                            <div class="form-group">
                                <label for="">Category</label>
                                <select id="" name="category[]" class="multi-tag-category form-control" placeholder="Select category" multiple>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Actor</label>
                                <select id="" class="multi-tag-actor" name="actor[]" placeholder="Select Actor" multiple>
                                </select>
                            </div>

                            <div class="form-group row">
                                <div class="form-group col-md-3">
                                    <input type="checkbox" class="form-check-input" name="is_movie18" id="is_movie18">
                                    <label class="form-check-label text-danger" for="is_movie18">Is 18+</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="checkbox" class="form-check-input" name="is_finished" id="is_finished">
                                    <label class="form-check-label text-danger" for="is_finished">Is finished+</label>
                                </div>


                                <div class="form-group col-md-3">
                                    <input type="checkbox" class="form-check-input" id="is_on_cinema" name="is_on_cinema">
                                    <label class="form-check-label text-danger" for="is_on_cinema">Being shown on cinema</label>
                                </div>



                            </div>
                            <div class="form-group row ">
                                <div class="form-group col-3">
                                    <input type="checkbox" class="form-check-input" name="is_movie_series" id="is_movie_series">
                                    <label class="form-check-label text-secondary" for="is_movie_series">Movie series</label>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary px-lg-5 float-left">Save</button>
                        </form>
                    </div>

                    <div class="progress mt-5" style="height: 50px" >
                        <div class="bar" style="height: 50px" ></div >
                        <div class="percent progess-bar" style="font-size: 10px ; line-height: 10px">0%</div >
                    </div>

                </div>
                <div class="row">
                    {{--                    <div class="progress col-12 mt-5">--}}
                    {{--                        <div class="bar" ></div >--}}
                    {{--                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>--}}
                    {{--                    </div>--}}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>



    <script>

        $('#description').summernote({
            toolbar: [
                // [groupName, [list of button]]
                // ['style', ['bold', 'italic', 'underline', 'clear']],
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

        var multipleCategory = new Choices('.multi-tag-category', {
            choices: @json($selected_categories),
            removeItemButton: true,
            maxItemCount:-1,
            searchResultLimit:5,
            renderChoiceLimit:5
        });
        var multipleActors= new Choices('.multi-tag-actor', {
            choices: @json($selected_actors),
            removeItemButton: true,
            maxItemCount:-1,
            searchResultLimit:5,
            renderChoiceLimit:5
        });
        var singleDefault = new Choices('.single-select', {

        });

        function previewImg(input){
            var file = $("#img").get(0).files[0];

            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    $("#preview-img").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }
        function previewBg(input){
            var file = $("#bg_img").get(0).files[0];

            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    $("#preview-bg").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }

        // var singleDefault = new Choices('.single-select', {
        //
        // });


        var SITEURL = "/";
        $(function() {
            $(document).ready(function()
            {
                var bar = $('.bar');
                var percent = $('.percent');
                $('#AddMovieForm').ajaxForm({
                    beforeSend: function() {
                        var percentVal = '0%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    complete: function(data) {

                        // console.log(data);


                        // alert(data.message);
                        // window.location.reload;
                    },
                    success: function (data) {
                        var dt = JSON.parse(data);
                        console.log(data);

                        alert(dt.message);
                        console.log(dt.redirectUrl);
                        if(dt.redirectUrl != "") {
                            window.location.href  = dt.redirectUrl;
                        }
                    },
                    error : function (data) {
                        // console.log(A.parse(data.) );
                        var errors =JSON.parse(data.responseText);
                        var e=  Object.values(errors);
                        var msg = "";
                        e.forEach(e=> {
                            msg = msg+e+'\n';
                        });
                        alert(msg);
                        // msg = msg + e + '\n'
                        // alert(errors.name)
                        // $errors.
                    },

                });
            });
        });


        // $("#token-field").tokenInput([
        //     {id: 7, name: "Ruby"},
        //     {id: 11, name: "Python"},
        //     {id: 13, name: "JavaScript"},
        //     {id: 17, name: "ActionScript"},
        //     {id: 19, name: "Scheme"},
        //     {id: 23, name: "Lisp"},
        //     {id: 29, name: "C#"},
        //     {id: 31, name: "Fortran"},
        //     {id: 37, name: "Visual Basic"},
        //     {id: 41, name: "C"},
        //     {id: 43, name: "C++"},
        //     {id: 47, name: "Java"}
        // ]);


        // $('#token-field').tokenfield('setTokens', [{ value: "blue", label: "Blau" }, { value: "red", label: "Rot" }]);

        // $('#token-field').tokenfield();

        $('#is_movie_series').change(function () {
            if(this.checked) {

            }
        });


    </script>
@endsection
