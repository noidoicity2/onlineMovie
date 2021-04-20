@extends('client.layout.mainLayout')
@section('content')
 <div class="">
     <div class="container mt-5  "  >
         <div class="row content-overlay">
             <div class="col-12  " id="el"  >

             </div>
             <div class="col-12 " id="alert-msg" >

             </div>
             <div class="col-12">

                 <button id="btn-bookmark" class="btn btn-success mt-2">Book Mark</button>
                 <button class="btn btn-success mt-2">Book Mark</button>
                 <button class="btn btn-success mt-2">Book Mark</button>
             </div>

         </div>
         <div class="row">
             <h2 class="text-light h-5">{{$movie->name}}</h2>

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
                        @if($movie->is_movie_series==0)
                        "file": "{{$movie->hls_url}}",
                        @else
                        "file": "{{$movie->episodes->first()->hls_url}}",
                        @endif

                        // "label": "360p SD",
                        // "default": "true"
                    }

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
                "3500": "high" ,

            },
            "controls": true,

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

        $('#btn-bookmark').click(function(e) {
            e.preventDefault();
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
                },1000)
                // alert(data.message);
            }).fail(function () {
                alert('error');
            });

        });
    </script>



@endsection
