<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Dashboard - SB Admin</title>
    <link href="/css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>
<body class="sb-nav-fixed">
@include("admin.layout.nav")
<div id="layoutSidenav">
@include("admin.layout.sideBar")
@section("content")
{{--    @include("admin.layout.content")--}}
@show
    <input type="hidden" id="csrf_field" value="{{csrf_token()}}">
</div>



{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="/js/scripts.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>--}}
{{--<script src="/assets/demo/chart-area-demo.js"></script>--}}
{{--<script src="/assets/demo/chart-bar-demo.js"></script>--}}
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
{{--<script src="/assets/demo/datatables-demo.js"></script>--}}
{{--<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>


<script src="{{asset('js/Category.js')}}"></script>
@section('custom_js')
@show

</body>
</html>
