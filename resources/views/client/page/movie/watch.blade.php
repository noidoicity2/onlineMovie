@extends('client.layout.mainLayout')
@section('content')
 <div class="">
     <div class="container mt-5  "  >
         <div class="row content-overlay">
             <div class="col-12  " id="el"  >

             </div>
             <div class="col-12  " id="backup-player"  >

             </div>
             <div class="col-12 " id="alert-msg" >

             </div>
             <div class="col-12 d-flex justify-content-center">

                 <button id="btn-bookmark" class="btn btn-danger mt-2"><i class="fa fa-bookmark" aria-hidden="true"></i> Book Mark</button>
                 <button id="btn-skip-intro" class="btn btn-primary mt-2"><i class="fa fa-forward" aria-hidden="true"></i> Skip intro</button>
                 <button id="btn-next-episode" class="btn btn-success mt-2">Next Episode</button>
             </div>

         </div>
         <div class="row">
{{--             <div class="col-3 mt-2 d-flex justify-content-center">--}}
{{--                 <img class="" src="{{$movie->img}}" style="max-width:100%" alt="">--}}
{{--                 br--}}
{{--                 <p class="text-light h-5 font-weight-bolder" style="color: #8a6d3b!important; font-size: 2.5rem">{{$movie->name}}</p>--}}

{{--             </div>--}}
             <div class="col-12">
                 <p class="text-light h-5 font-weight-bolder" style=" color: #c69500!important; font-size: 2.5rem">{{$movie->name}}</p>
{{--                 <p> {!!html_entity_decode($movie->description) !!}</p>--}}
                 <p>

{{--                     <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                         Toggle description--}}
{{--                     </button>--}}
{{--                     <label class="text-light" for="">Show description</label>--}}
{{--                     <input type="checkbox"   data-toggle="collapse"  data-target="#collapseExample"   data-on="<i class='fa fa-play'></i> Play" data-off="<i class='fa fa-pause'></i> Pause">--}}

                 </p>
                 <div class="overflow-auto mb-5 " style="max-height: 300px; " id="">
                     <div class="card card-body  " style="background-color: #081b27!important;">
                         {!! html_entity_decode($movie->description) !!}
                     </div>
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

                "image":"{{$movie->img}}",
                "sources": [

                    {

                        "file": "{{$movie->hls_url}}",


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

                    "image":"{{$movie->img}}",
                    "sources": [

                        {

                            "file": "{{$movie->source_url}}",



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


        });
        // var elapsed = player
        // var saveBtn = document.getElementById("save-btn");
        // var elapsed ;
        // saveBtn.onclick = function () {
        //      elapsed = player.getPosition();
        //     console.log(elapsed);
        //    // player.pause();
        // }

        $("#btn-bookmark").click(function () {
             elapsed = player.getPosition();
            console.log(elapsed);
        });
        $("#btn-skip-intro").click(function () {
            elapsed = player.getPosition();
            jwplayer().seek({{$movie->intro_end}});

            console.log("seeking" );
        });

        $('#btn-bookmark').click(function(e) {
            e.preventDefault();
            // $("#alert-msg").toggle(500)
            elapsed = player.getPosition();
            $.ajax({
                url: '{{route('add_to_bookmark')}}',
                type: 'POST',
                dataType: 'json',
                data: {
                    "user_id":'{{Auth::id()}}',
                    "movie_id":'{{$movie->id}}' ,
                    "_token": "{{ csrf_token() }}",
                    "episode_id": null,
                    "position" : elapsed,
                }
            }).done(function (data) {

                var htm =
                    ` <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
                          <strong>${data.message}</strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                `
                $("#alert-msg").append(htm);
                console.log(data);
                window.setTimeout(()=> {
                    $("#alert-msg").empty();
                },2000)
                // alert(data.message);
                // $("#alert-msg").fadeIn(3000);
                // $("#alert-msg").toggle(1000);
                // $("#alert-msg").hide();
            }).fail(function () {
                alert('error');
            });

        });
    </script>



@endsection
