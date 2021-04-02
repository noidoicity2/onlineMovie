@extends('client.layout.mainLayout')
@section('content')
    <div class="container">
        <div class="row content-overlay">
            <div class="col-12" id="el">

            </div>

        </div>
        <div class="row">
            <h2 class="text-light h-5">{{$movie->name}}</h2>
        </div>
    </div>
@endsection
@section('custom_js')
    <script type="text/JavaScript">
        jwplayer("el").setup({
            "playlist": [{

                "image":"{{$movie->img}}",
                "sources": [
                    //     {
                    //     "file": "/storage/react.MP4",
                    //     "label": "720p HD"
                    // },
                    {
                        "file": "{{$movie->low_hls_url}}",
                        // "label": "360p SD",
                        // "default": "true"
                    },
                    //     {
                    //     "file": "/uploads/myVideo180.mp4",
                    //     "label": "180p Web"
                    // }
                ]
                // "file": "images/react.mp4"
            }],
            // "autostart": "true",
            "displaytitle" : true,
            "playbackRateControls": true,
            "playbackRates ":[0.25, 0.75, 1, 1.25],
            "qualityLabels":{"200":"Low"},
            "controls": true,

        });
    </script>
@endsection
