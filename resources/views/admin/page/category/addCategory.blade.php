@extends("admin.layout.mainLayout")

@section("content")

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Add category</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Add new category</li>
                </ol>
                <div class="row">
                    <div class="col-xl-12 col-md-12">
{{--                        <form>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleFormControlInput1">Email address</label>--}}
{{--                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleFormControlSelect1">Example select</label>--}}
{{--                                <select class="form-control" id="exampleFormControlSelect1">--}}
{{--                                    <option>1</option>--}}
{{--                                    <option>2</option>--}}
{{--                                    <option>3</option>--}}
{{--                                    <option>4</option>--}}
{{--                                    <option>5</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleFormControlSelect2">Example multiple select</label>--}}
{{--                                <select multiple class="form-control" id="exampleFormControlSelect2">--}}
{{--                                    <option>1</option>--}}
{{--                                    <option>2</option>--}}
{{--                                    <option>3</option>--}}
{{--                                    <option>4</option>--}}
{{--                                    <option>5</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="form-group">--}}
{{--                                <label for="exampleFormControlTextarea1">Example textarea</label>--}}
{{--                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>--}}
{{--                            </div>--}}
{{--                        </form>--}}
                        <form method="post" action="{{route("post_add_category")}}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="inputFirstname">Category name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="First name">
                                </div>
                                <div class="col-sm-6">
                                    <label for="inputLastname">Slug (seo)</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Last name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="inputAddressLine1">Description</label>
                                    <textarea type="text" name="description" id="description" class="form-control" id="inputAddressLine1" placeholder="">

                                    </textarea>
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
