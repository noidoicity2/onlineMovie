<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Online Movie Website</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/fonts/material-icon/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
{{--    <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">--}}
{{--    <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />--}}
    <link rel="stylesheet" href="{{asset('/vendor/owl/assets/owl.carousel.css')}}">

    <link rel="stylesheet" href="{{asset('/vendor/owl/assets/owl.carousel.min.css')}}">
    <!-- Custom styles for this template -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/movie.detail.css')}}">
    <meta http-equiv="X-UA-Compatible" name="description" content="Home page for online movie">
</head>

<body>

<!-- Navigation -->
@include('client.layout.nav')


{{--main content--}}
@section('content')
{{--    @include('client.layout.mainContent')--}}
@show


{{--end main content--}}

    <!-- Portfolio Section -->




</div>



<!-- /.container -->

<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright @ Văn Đạt</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
{{--<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>--}}

{{--<script src="https://cdn.jwplayer.com/libraries/0mpSUyh4.js"></script>--}}
<script src="https://cdn.jwplayer.com/libraries/KVxscqKF.js"></script>
<script src="{{asset('/vendor/owl/owl.carousel.min.js')}}"></script>
<script src="{{asset('/vendor/owl/assets/owl.theme.default.min.css')}}"></script>


@section('custom_js')
@show
</body>

</html>
