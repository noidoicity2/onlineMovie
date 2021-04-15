<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modern Business - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
    <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
{{--    <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />--}}

    <!-- Custom styles for this template -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/movie.detail.css')}}">

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
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jwplayer.com/libraries/0mpSUyh4.js"></script>

@section('custom_js')
@show
</body>

</html>
