@extends("admin.layout.mainLayout")

@section("content")

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Add Membership</h1>
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
                        <form method="post" action="{{route("post_add_membership")}}">
                            @csrf
                            <div class="form-group ">

                                    <label for="inputFirstname">Membership name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name">

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="inputAddressLine1">Description</label>
                                    <textarea name="description" id="description" class="form-control" id="description" placeholder="Enter Description">

                                    </textarea>
                                </div>

                            </div>
                            <div class="form-group ">

                                <label for="inputFirstname">Price</label>
                                <input type="text" class="form-control" name="price" id="price" placeholder="Enter category name">

                            </div>
                            <div class="form-group ">

                                <label for="price">Number of days</label>
                                <input type="text" class="form-control" name="number_of_day" id="number_of_day" placeholder="Enter number of day">

                            </div>
                            <div class="form-group ">


                                <input type="checkbox" class="form-check-inline" name="all_category" id="all_category" placeholder="Enter number of day">
                                <label class="form-check-label"  for="all_category">Include all movie category</label>
                            </div>
                            <label class="col-12 form-check-label text-danger  font-weight-bolder  " for="info">Include categories</label>
                            <div class="form-group row mx-auto font-weight-bolder " style="height: 200px ; overflow: scroll">

                                @foreach($categories as $category)
                                    <div class="form-group col-3 p-4">
                                        <input type="checkbox" class="form-check-input" value="{{$category->id}}" name="category[]{{$category->id}}" id="category_{{$category->id}}">
                                        <label class="form-check-label text-primary" for="category_{{$category->id}}">{{$category->name}}</label>
                                    </div>
                                @endforeach
                                <input type="hidden" value="">

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
