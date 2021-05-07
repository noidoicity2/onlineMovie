@extends('client.layout.mainLayout')
@section('content')
    <div class="container-fluid">
        <!--    <h1 class="movie-title">Movie title</h1>-->
        <div class=" content-wrapper" @if($movie->bg_img) style="background-image: url({{$movie->bg_img}});" @endif>
            <div class="row content-overlay">
                <div class="col-12 col-sm-6 img-area d-flex flex-column ">
                    <div class="img-left-container d-flex justify-content-center">
                        <img class="film-img" src="{{$movie->img}}" alt="">
                    </div>
{{--                    <input type="hidden" id="movie_id" value="{{$movie->id}}" >--}}
                    <div class="group-btn d-flex mt-3 flex-wrap" >
                        @if($movie->is_movie_series ==0)
                            <a  href="{{route('watch_movie',['slug' => $movie->slug , 'id' => $movie->id])}}" type="button" style="line-height: 50px ; font-size: 20px" class="btn bg-success text-light  m-1 w-25" ><i class="bi bi-play-fill"></i>
                                Watch</a>
                        @endif

                            @auth
                            <a id="like-btn" type="button" style="line-height: 50px ; font-size: 20px" class="btn bg-danger text-light  m-1 w-25 "><i class="bi bi-heart"></i>
                                @if($is_liked == 0)
                                <span id="like-text">like</span></a>
                                @else
                             <span id="like-text">Unlike</span></a>
                                 @endif
                            @endauth


                        @if($movie->is_movie_series == 1)
                        <a   href="{{route('list_episode' , ['slug' => $movie->slug , 'id'=> $movie->id])}}" type="button" style="line-height: 50px ; font-size: 20px" class="btn bg-danger text-light m-1  w-25 "><i class="bi bi-list"></i>
                             Episodes</a>
                        @endif
                    </div>

                </div>

                <div class="col-12 col-sm-6 right-detail">
                    <h1 class="film-title">{{$movie->name}}</h1>
                    <h2 class="en-title">{{$movie->en_name}}</h2>
                    <p class="detail-item">Diretor: {{$movie->director->name ?? "unknown"}}</p>
                    <p class="detail-item">Quality: {{$movie->quality_label}}</p>
                    <p class="detail-item">Actor :  @foreach($actors as $actor) <a href="">{{$actor->actor->name ?? ""}}</a> , @endforeach </p>
                    <p class="detail-item">Genre: @foreach($categories as $category) <a href="{{route('get_movie_by_category' ,['slug' => $category->category->slug , 'id' =>$category->category_id])}}">{{$category->category->name}}</a> , @endforeach</p>
                    <p class="detail-item">Duration: {{$movie->duration}} minutes</p>
                    <p class="detail-item">Nation: {{$movie->country->name ?? ""}}</p>
                    <p class="detail-item">Total view: {{$movie->view_count}}</p>
                    <p class="detail-item">Publish date: {{date('d-m-Y', strtotime($movie->created_at))}}</p>
                    <p class="detail-item">Total Episode: {{$movie->total_episode}}</p>
                    <p class="detail-item">List episode {{$movie->episodes->count()}}:</p>
                   <div>
                     <p style="font-size: 2rem; color: #c69500 ;margin-bottom: 1.5px"> Ratings: </p>
                       <span class="text-light font-weight-bolder" style="font-size: 3rem">{{$avg_rating}}  </span>
                        @for($i =1 ; $i <= 10 ; $i++)
                            @if($i <= $avg_rating)
                                <i  class="rate_{{$i}} fa fa-star " alt="{{$i}}"   style="font-size: 2rem;color: #c69500 ; cursor: pointer ; " aria-hidden="true" ></i>
                            @else
                                <i  class="rate_{{$i}} fa fa-star " alt="{{$i}}"   style="font-size: 2rem;color: #4a5568 ; cursor: pointer ; " aria-hidden="true" ></i>
                            @endif
                       @endfor
                       <p class="text-secondary">( {{$rating_count}} votes  )</p>
{{--                       <span>/ {{$rating_count}} </span>--}}



                   </div>



                </div>
            </div>


        </div>

        <div class="section-detail">
            <div class="row">
                <div class="col-12 text-light">
                    <h2>Description</h2>
                   {!!html_entity_decode($movie->description) !!}
                </div>
            </div>
        </div>
        @auth
        <div class="section-comment">
            <h2>Comments</h2>
            <div class="row">
                <div class="col-12">
                    <form action="" class="form-group">
                        <textarea id="comment" class="form-control-lg w-100" style="height: 100px" id="" cols="30" placeholder="Leave a commenet" name="commentcomment" rows="30"></textarea>
                        <button id="send-cmt" class="btn btn-primary float-right mb-2">Send</button>
                    </form>

                </div>
                <div class="comment col-12" id="comment-container">
                    @foreach($comments as $comment)
                        <div class="col-12 border border-primary mb-2">
                            <h5 class="text-warning font-weight-bolder">{{$comment->user->name}}</h5>
                            <p class="text-light text-info">{{$comment->content}}</p>
                        </div>
                    @endforeach


                </div>


            </div>
        </div>
        @endauth


        <div class="section-related">

<div class="row">
    <div class="col-12">Related Movie</div>
            @foreach($related_movies as $related )



                <div class="col-md-2 col-lg-2  col-sm-6">

                    <a href="{{route('get_movie_by_slug',['slug' => $related->slug , 'id' => $related->id])}}" class="film-item">
                        @if($related->is_movie_series == 1)
                            <div class="total-episode">{{$related->episodes_count}}/ {{$related->total_episode}} episodes</div>
                        @else
                            <div class="ribbon">{{$related->quality_label ?? "Full HD"}}</div>
                        @endif

                        @if($related->is_free)
                            <div class="is-free">Free</div>
                        @else
                            <div class="is-premium"><i class="fa fa-usd" aria-hidden="true"></i> Vip</div>
                        @endif
                        <img class="movie-img" loading="lazy" src="{{$related->img}}" alt="">

                        <p>{{$related->name}}</p>
                        {{--                                <p>free {{$movie->is_free}}</p>--}}
                        <span>{{$related->en_name}}</span>
                    </a>
                </div>
            @endforeach
</div>
        </div>

        <!-- Portfolio Section -->


    </div>
@endsection

@section('custom_js')
    <script>
        $('#like-btn').click(function(e) {
            e.preventDefault();

                $.ajax({
                    url: '{{route('add_to_favorite')}}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        "movie_id": {{$movie->id}},
                        "_token": "{{ csrf_token() }}",
                    }
                }).done(function (data) {
                    // $('#noidung').html(ketqua);
                   var liketxt = $('#like-text').text();
                   if(liketxt == 'like') {
                       $('#like-text').text('unlike');
                   }else  {
                       $('#like-text').text('like');
                   }
                    alert(data.message);
                }).fail(function () {
                    alert('error');
                });

        });

// rating
        @auth
        $('i[class^="rate_"]').click(function () {
            console.log($(this).attr('alt'));
            // console.log("dasd");

            $.ajax({
                url: '{{route('post_rate_movie')}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "movie_id": {{$movie->id}},
                    "user_id"  : {{Auth::id()}},
                    "rating_point": $(this).attr('alt'),
                    "_token": "{{ csrf_token() }}",
                }
            }).done(function (data) {
                // $('#noidung').html(ketqua);
                alert(data.message);
                location.reload();
            }).fail(function () {
                alert('error');
            });

        });

        $('#send-cmt').click(function (e) {
            e.preventDefault();
            var cmt = $('#comment').val();
            var name = '{{Auth::user()->name}}'
            var template = `
               <div class="col-12 border border-primary mb-2">
                        <h5 class="text-warning font-weight-bolder"> ${name} </h5>
                        <p class="text-light text-info"> ${cmt}</p>
               </div>
            `;
            $('#comment-container').prepend(template);

            $.ajax({
                url: '{{route('post_add_comment')}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "movie_id": {{$movie->id}},
                    "user_id"  : {{Auth::id()}},
                    "comment": $('#comment').val(),
                    "_token": "{{ csrf_token() }}",
                }
            }).done(function (data) {
                // $('#noidung').html(ketqua);
                alert(data.message);
                location.reload();
            }).fail(function () {
                alert('error');
            });

        });
        @endauth
    </script>
@endsection
