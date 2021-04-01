
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
                </div>
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <form action="{{route('post_add_movie')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Movie Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter movie name">
                            </div>
                            <div class="form-group">
                                <label for="en_name">Real Name</label>
                                <input type="text" class="form-control" name="en_name" id="en_name" placeholder="Enter real name">
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-6">
                                    <label for="img">Choose image</label>
                                    <input type="file" class="form-control" name="img" id="img">
                                </div>
                                <div class="form-group col-6">
                                    <label for="bg_img">Choose back ground image</label>
                                    <input type="file" class="form-control" name="bg_img" id="bg_img">
                                </div>
                                <div class="form-group col-12">
                                    <label for="source_url">Choose video source</label>
                                    <input type="file" class="form-control" name="source_url" id="source_url">
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="is_free">For free user</label>
                                <input name="is_free" id="is_free" type="checkbox">
                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <select class="form-control" name="country" id="country">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach

                                </select>
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="country">Category</label>--}}
{{--                                <select class="form-control" name="category_id" id="category_id">--}}
{{--                                    @foreach($countries as $country)--}}
{{--                                        <option value="{{$country->id}}">{{$country->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
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
                                <textarea class="form-control" id="info" name="description" rows="3"></textarea>
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
                                    <input type="checkbox" class="form-check-input" name="is_movie_series" id="is_movie_series">
                                    <label class="form-check-label text-danger" for="is_movie_series">Movie series</label>
                                </div>

                                <div class="form-group col-md-3">
                                    <input type="checkbox" class="form-check-input" id="is_on_cinema" name="is_on_cinema">
                                    <label class="form-check-label text-danger" for="is_on_cinema">Being shown on cinema</label>
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
