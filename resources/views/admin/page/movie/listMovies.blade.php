@extends("admin.layout.mainLayout")

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">List Movies</h1>
                <ol class="breadcrumb mb-4">
{{--                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>--}}
                    <li class="breadcrumb-item active">Movie List</li>
                </ol>
{{--                @if(Request::get('keyword') != "")--}}
                <h2>Found {{$movies->total() ?? ""}} results</h2>
{{--                @endif--}}
                <div class="row">
                    <form class="form-inline mb-2"  action="">
                        <div class="form-group form-inline ml-5">
                            <input  value="{{Request::get('keyword')}}" class="form-control"  name="keyword" type="text" placeholder="enter name to search">
                            <select class="mt-1 mr-2 form-control  form-control bg-dark text-light" name="category_id" aria-label="Default select example">
                                <option value="">Category</option>
                                @foreach($selectCategories as $category)
                                    <option @if($category->id == Request::get('category_id'))  selected @endif value="{{$category->id}}">{{substr($category->name , 0 ,10)}}</option>
                                @endforeach
                            </select>
                            <select class="mt-1 mr-2 form-control  form-control bg-dark text-light"  name="country_id" aria-label="Default select example">
                                <option value="" >Country</option>
                                @foreach($selectCountries as $country)
                                    <option @if($country->id == Request::get('country_id'))  selected @endif value="{{$country->id}}">{{substr($country->name , 0 , 10)}}</option>
                                @endforeach
                            </select>
                            <select class="mt-1 mr-2 form-control  form-control bg-dark text-light" name="is_on_cinema" aria-label="Default select example">

                                <option  @if(0 == Request::get('is_on_cinema'))  selected @endif value="0" >In theater</option>
                                <option  @if(1 == Request::get('is_on_cinema'))  selected @endif value="1">Not theater</option>
                                <option  @if( Request::get('is_on_cinema') == "")  selected @endif value="" >Is in theater</option>
{{--                                <option  @if(0 == Request::get('is_on_cinema'))  selected @endif value="0">No</option>--}}

                            </select>
                            <select class="mt-1 mr-2 form-control  form-control bg-dark text-light" name="is_free" aria-label="Default select example">

                                <option  @if(1 == Request::get('is_free'))  selected @endif  value="1">free</option>
                                <option  @if(0 == Request::get('is_free'))  selected @endif  value="0">premium</option>
                                <option  @if("" == Request::get('is_free'))  selected @endif  value="">Is free</option>

                            </select>
                            <select class="mt-1 mr-2 form-control  form-control bg-dark text-light" name="is_movie_series" aria-label="Default select example">
{{--                                <option value="" >Is movie series</option>--}}
                                <option  @if(1 == Request::get('is_movie_series'))  selected @endif  value="1">movie series</option>
                                <option @if(0 == Request::get('is_movie_series'))  selected @endif value="0">short movies</option>
                                <option  @if("" == Request::get('is_movie_series'))  selected @endif  value="">Is movie series</option>
                            </select>
                            <select class="mt-1 mr-2 form-control  form-control bg-dark text-light"  name="actor_id" aria-label="Default select example">
                                <option value="" >Actor</option>
                                @foreach($selectActors as $actor)

                                    <option  @if($actor->id == Request::get('actor_id'))  selected @endif  value="{{$actor->id}}" >{{$actor->name}}</option>
                                @endforeach
                            </select>
                            <select class="mt-1 mr-2 form-control  form-control bg-dark text-light"  name="director_id" aria-label="Default select example">
                                <option value="" >Director</option>
                                @foreach($selectDirectors as $director)

                                    <option  @if($director->id == Request::get('director_id'))  selected @endif  value="{{$director->id}}" >{{$director->name}}</option>
                                @endforeach
                            </select>
{{--                            <select class="mt-1 mr-2 form-control form-control  bg-dark text-light" name="published_at" aria-label="Default select example">--}}
{{--                                <option value="" selected>Published year</option>--}}
{{--                                @for($i= 1990 ; $i < 2022 ; $i++)--}}
{{--                                    <option @if($i == Request::get('published_at'))  selected @endif  value="{{$i}}">{{$i}}</option>--}}
{{--                                @endfor--}}

{{--                            </select>--}}
                            <button type="submit" class="btn btn-primary "><i class="fa fa-filter"></i></button>
                        </div>

                    </form>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                      List Movie
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>image</th>
                                    <th>movie series</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>image</th>
                                    <th>movie series</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>

                                @if(isset($movies))
                                    @foreach($movies as $movie)
                                        <tr>
                                            <td >{{$movie->id}}</td>
                                            <td>
                                                <p class="text-success">  {{$movie->name}}</p>
                                              <p>Ratings: {{number_format($movie->rating ,1) }} <i class="fa fa-star" aria-hidden="true"></i>
                                              </p>

                                            </td>
                                            <td><img class="mx-auto d-block " style="height: 100px" src="{{$movie->img}}" alt=""> </td>
                                            <td style="max-width: 300px">

                                                    @if($movie->is_movie_series)
                                                        <p>
                                                            <i class="fa fa-check" aria-hidden="true"></i>
                                                        </p>
                                                        <p>@foreach($movie->episodes as $episode)
                                                                <a href="{{route('watch_episode' , ['slug' => $episode->slug , 'id' =>$episode->id])}}" class="badge badge-primary">{{$episode->name ?? ""}}</a>


                                                            @endforeach</p>

                                                    @endif


                                            </td>
                                            <td style="text-align: center; max-width: 100px">
                                                <button class="btn btn-danger rounded-circle delete-btn" ><i class="fa fa-trash"></i></button>
                                                <a href="{{route('edit_movie' , ['id' => $movie->id])}}" class="btn btn-info rounded-circle update-btn" ><i class="fa fa-pen"></i></a>
                                                @if($movie->is_movie_series == 1)
                                                <a title="Add episode" class="btn btn-primary"   href="{{route('add_episode' ,['id'=> $movie->id])}}"><i class="fa fa-plus"></i>Add episode</a>
                                                    @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                @else

                                @endif



                                </tbody>

                            </table>
                        {{$movies->links()}}

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
        $(document).ready(function() {
            $('#dataTable').DataTable( {
                "paging":   false,

                "info":     false
            } );
        } );

        $(".delete-btn").click(function () {
            if(!confirm("are you sure")) return false;
            var id = $(this).parent().parent().children().eq(0).text();
            var csrf =  $('#csrf_field').val();

            // console.log(csrf);

            $.ajax({
                method: "POST",
                url: "{{route('post_delete_movie')}}",
                dataType: "json",
                // contentType: 'application/json',
                data: {
                    'id': id,
                    '_token': csrf,

                },
                success: function (data) {
                    // console.log(data);

                    if(data.success) {
                        alert("delete Movie #"+id+" successfully");
                        location.reload();
                    }
                    else alert("Something went wrong ! Cannot delete category")


                },
                error: function(xhr, status, error){
                    let errorMessage = xhr.status + ': ' + xhr.statusText
                    alert('Error - ' + errorMessage);
                }
            });

            // console.log(id);
        });
    </script>
@endsection
