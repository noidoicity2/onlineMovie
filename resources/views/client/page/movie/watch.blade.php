@extends('client.layout.mainLayout')
@section('content')
    <div class="container">
        <div class="row content-overlay">
            <div class="col-12" id="el">

            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    <script type="text/JavaScript">
        jwplayer("el").setup({
            "playlist": [{

                "image":"images/0.jpg",
                "sources": [
                    //     {
                    //     "file": "/storage/react.MP4",
                    //     "label": "720p HD"
                    // },
                    {
                        "file": "{{$movie->hls_url}}",
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
            "autostart": "viewable",
            "displaytitle" : true,
            // "qualityLabels":{"2500":"High","1000":"Medium"}

        });
    </script>
@endsection
