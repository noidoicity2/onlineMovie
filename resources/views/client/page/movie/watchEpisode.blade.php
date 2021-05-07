@extends('client.layout.mainLayout')
@section('content')
    <div class="container">
        <div class="row content-overlay mt-5">
            <div class="col-12" id="el">

            </div>
            <div class="col-12  " id="backup-player"  >

            </div>
            <div class="col-12" id="alert-msg" >

            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal-bookmark" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            You are watching this movie at  {{$bookmark->position ?? 0}} seconds
                        </div>
                        <div class="modal-footer">
                            {{--                             data-dismiss="modal"--}}
                            <button type="button" id="start-over" class="btn btn-secondary" >Start over</button>
                            <button type="button" id="btn-go-bookmark"  class="btn btn-primary">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000">
                <div class="toast-header">
                    {{--                     <img src="..." class="rounded mr-2" alt="...">--}}
                    <strong class="mr-auto">Alert</strong>
                    <small>11 mins ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body" id="alert-toast">
                    Hello, world! This is a toast message.
                </div>
            </div>
            <div class="col-12 d-flex justify-content-sm-center">

                <button id="btn-bookmark" class="btn btn-danger mr-2 mt-2"><i class="fa fa-bookmark" aria-hidden="true"></i> Book Mark</button>
                <button id="btn-skip-intro" class="btn btn-primary mr-2  mt-2"><i class="fa fa-forward" aria-hidden="true"></i> Skip intro</button>
                {{--                 <button id="btn-go-bookmark" class="btn btn-secondary mr-2  mt-2"><i class="fa fa-forward" aria-hidden="true"></i> Good to bookmark </button>--}}
                <a id="btn-next-episode" href="{{route('watch_episode' , ['slug' => $next_episode->slug , 'id' => $next_episode->id])}}"  class="btn btn-success mr-2  mt-2">Next Episode</a>

            </div>

        </div>
        <h2 class="" style="margin-top: 50px">{{$episode->movie->name}}</h2>
        <div class="row mb-lg-5">

            @foreach($episodes as $e )
                @if($e->id == $episode->id)
                    <a  href="{{route('watch_episode' , ['slug' => $e->slug , 'id' => $e->id])}}" class="col-md-1 col-sm-12 btn btn-outline-success align-middle mr-2 mb-2 text-capitalize " >{{$e->name}}</a>

                @else
                    <a  href="{{route('watch_episode' , ['slug' => $e->slug , 'id' => $e->id])}}" class="col-md-1 col-sm-12 btn btn-outline-warning align-middle mr-2 mb-2 text-capitalize " >{{$e->name}}</a>

                @endif

            @endforeach

        </div>
        <div class="row">
            <div class="col-12">
                <div class="overflow-auto mb-5 " style="max-height: 300px; " id="">
                    <div class="card card-body  " style="background-color: #081b27!important;">
                        {!! html_entity_decode($episode->movie->description) !!}
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('custom_js')
    <script type="text/JavaScript">
        var player = jwplayer("el");
        player.setup({
            "playlist": [{

                "image":"{{$episode->movie->img}}",
                "sources": [

                    {

                        "file": "{{$episode->hls_url}}",


                        // "label": "360p SD",
                        // "default": "true"
                    },


                ]
                // "file": "images/react.mp4"
            },

            ],
            "autostart": "true",
            "displaytitle" : true,
            "playbackRateControls": true,
            "playbackRates ":[0.25, 0.75, 1, 1.25],
            "qualityLabels":{
                "200": "low",
                "2000": "high" ,
                "3000": "very high" ,

            },
            "controls": true,

        });

        player.on('error',function(){
            console.log("dasd");
            player.remove();
            var backUpPlayer = jwplayer("backup-player");

            backUpPlayer.setup({
                "playlist": [{

                    "image":"{{$episode->movie->img}}",
                    "sources": [

                        {

                            "file": "{{$episode->source_url}}",



                        },


                    ]
                    // "file": "images/react.mp4"
                },

                ],
                // "autostart": "true",
                "displaytitle" : true,
                "playbackRateControls": true,
                "playbackRates ":[0.25, 0.75, 1, 1.25],
                "qualityLabels":{
                    "200": "low",
                    "2000": "high" ,
                    "3000": "very high" ,

                },
                "controls": true,

            });


        });

        {{--var player = jwplayer("el");--}}
        {{--player.setup({--}}
        {{--    "playlist": [{--}}

        {{--        "image":"{{$episode->movie->img}}",--}}
        {{--        "sources": [--}}
        {{--            {--}}
        {{--                "file": "{{$episode->hls_url}}",--}}
        {{--            },--}}

        {{--        ]--}}
        {{--        // "file": "images/react.mp4"--}}
        {{--    },--}}

        {{--    ],--}}
        {{--    "autostart": "true",--}}
        {{--    "displaytitle" : true,--}}
        {{--    "playbackRateControls": true,--}}
        {{--    "playbackRates ":[0.25, 0.75, 1, 1.25],--}}
        {{--    "qualityLabels":{--}}
        {{--        "200": "low",--}}
        {{--        "2000": "high" ,--}}
        {{--        "3000": "very high" ,--}}

        {{--    },--}}
        {{--    "controls": true,--}}

        {{--});--}}

        {{--player.on('error',function(){--}}
        {{--    console.log("dasd");--}}
        {{--    var jwElement = document.getElementById('el');--}}
        {{--    // jwElement.remove();--}}
        {{--    var backUpPlayer = jwplayer("backup-player");--}}

        {{--    backUpPlayer.setup({--}}
        {{--        "playlist": [{--}}

        {{--            "image":"{{$episode->movie->img}}",--}}
        {{--            "sources": [--}}
        {{--                {--}}
        {{--                    "file": "{{$episode->source_url}}",--}}
        {{--                },--}}

        {{--            ]--}}
        {{--            // "file": "images/react.mp4"--}}
        {{--        },--}}

        {{--        ],--}}
        {{--        "autostart": "true",--}}
        {{--        "displaytitle" : true,--}}
        {{--        "playbackRateControls": true,--}}
        {{--        "playbackRates ":[0.25, 0.75, 1, 1.25],--}}
        {{--        "qualityLabels":{--}}
        {{--            "200": "low",--}}
        {{--            "2000": "high" ,--}}
        {{--            "3000": "very high" ,--}}

        {{--        },--}}
        {{--        "controls": true,--}}

        {{--    });--}}


        {{--});--}}
        $("#btn-go-bookmark").click(function () {
            $('#modal-bookmark').modal('hide');
            var pos = {{$bookmark->position?? 0}} ;
            console.log('go to' + pos);

            if(pos < 10) {
                // $('.toast').toast('show')
                $("#alert-toast").html("You haven't booked mark this movie")
                $('.toast').toast('show')
                return;
            }
            jwplayer().seek(pos);
        });
        $("#btn-skip-intro").click(function () {
            // elapsed = jwplayer().getPosition();
            jwplayer().seek({{$episode->movie->intro_end}});

            console.log("seeking" + {{$episode->movie->intro_end}});
        });

        $(document).ready(function () {
            var bm = {{$bookmark->position ?? 0}} ;
            console.log('bookmark');
            if(bm > 10) {
                $('#modal-bookmark').modal('show');
            }
            $('#start-over').click(function () {
                jwplayer().seek(0);
                $("#modal-bookmark").modal('hide');
            })

        })



        $('#btn-bookmark').click(function(e) {
            e.preventDefault();
            // $("#alert-msg").toggle(500)
            elapsed = jwplayer().getPosition();
            $.ajax({
                url: '{{route('add_to_bookmark')}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "user_id":'{{Auth::id()}}',
                    "movie_id":'{{$episode->movie->id}}' ,
                    "_token": "{{ csrf_token() }}",
                    "episode_id": {{$episode->id}},
                    "position" : elapsed,
                }
            }).done(function (data) {

                // var htm =
                //     ` <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                //           <strong>${data.message}</strong>
                //           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                //             <span aria-hidden="true">&times;</span>
                //           </button>
                //       </div>
                // `
                var msg = "Bookmark movie successfully "
                $("#alert-toast").html(msg)
                $('.toast').toast('show')
                // $("#alert-msg").append(htm);
                console.log(data);
                // window.setTimeout(()=> {
                //     $("#alert-msg").empty();
                // },2000)
                // alert(data.message);
                // $("#alert-msg").fadeIn(3000);
                // $("#alert-msg").toggle(1000);
                // $("#alert-msg").hide();
            }).fail(function () {
                alert('error');
            });

        });


        // var elapsed = player
        {{--var saveBtn = document.getElementById("save-btn");--}}
        {{--var elapsed ;--}}
        {{--saveBtn.onclick = function () {--}}
        {{--    elapsed = player.getPosition();--}}
        {{--    console.log(elapsed);--}}
        {{--    // player.pause();--}}
        {{--}--}}

        {{--$("#btn-bookmark").click(function () {--}}
        {{--    elapsed = player.getPosition();--}}
        {{--    console.log(elapsed);--}}
        {{--});--}}

        {{--$('#btn-bookmark').click(function(e) {--}}
        {{--    e.preventDefault();--}}
        {{--    elapsed = player.getPosition();--}}
        {{--    $.ajax({--}}
        {{--        url: '{{route('add_to_bookmark')}}',--}}
        {{--        type: 'POST',--}}
        {{--        dataType: 'json',--}}
        {{--        data: {--}}
        {{--            "user_id":'{{Auth::id()}}',--}}
        {{--            "movie_id":'{{$episode->id}}' ,--}}
        {{--            "_token": "{{ csrf_token() }}",--}}
        {{--            "episode_id": null,--}}
        {{--            "position" : elapsed,--}}
        {{--        }--}}
        {{--    }).done(function (data) {--}}
        {{--        // $('#noidung').html(ketqua);--}}
        {{--        var htm =--}}
        {{--            ` <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">--}}
        {{--                  <strong>${data.message}</strong>--}}
        {{--                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
        {{--                    <span aria-hidden="true">&times;</span>--}}
        {{--                  </button>--}}
        {{--              </div>--}}
        {{--        `--}}
        {{--        $("#alert-msg").append(htm);--}}
        {{--        console.log(data);--}}
        {{--        window.setTimeout(()=> {--}}
        {{--            $("#alert-msg").empty();--}}
        {{--        },1000)--}}
        {{--        // alert(data.message);--}}
        {{--    }).fail(function () {--}}
        {{--        alert('error');--}}
        {{--    });--}}

        {{--});--}}
    </script>



@endsection
