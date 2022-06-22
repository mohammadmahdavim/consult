<!DOCTYPE html>
<html lang="fa">
<head>
    <meta name="_token" content="{{ csrf_token() }}" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>مشاوره برترها</title>

    <!-- begin::global styles -->
    <link rel="stylesheet" href="/panel/assets/vendors/bundle.css" type="text/css">
    <!-- end::global styles -->

    <link rel="stylesheet" href="/panel/assets/vendors/swiper/swiper.min.css">

    <!-- begin::custom styles -->
    <link rel="stylesheet" href="/panel/assets/css/app.css" type="text/css">
    <link rel="stylesheet" href="/panel/assets/css/custom.css" type="text/css">
    <!-- end::custom styles -->

    <!-- begin::favicon -->
    <link rel="shortcut icon" href="/panel/assets/media/image/favicon.png">
    <!-- end::favicon -->

    <!-- begin::theme color -->
    <meta name="theme-color" content="#3f51b5"/>
    <!-- end::theme color -->
@yield('css')
</head>
<body>

<!-- begin::page loader-->
<div class="page-loader">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<!-- end::page loader -->

<!-- begin::side menu -->
@include('include.panel.menu')

<!-- end::side menu -->

<!-- begin::navbar -->
@include('include.panel.header')

<!-- end::navbar -->

<!-- begin::main content -->
@yield('content')
<!-- end::main content -->

<!-- begin::global scripts -->
<script src="/panel/assets/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::chart -->
<script src="/panel/assets/vendors/charts/chart.min.js"></script>
<script src="/panel/assets/vendors/charts/sparkline.min.js"></script>
<script src="/panel/assets/vendors/circle-progress/circle-progress.min.js"></script>
<script src="/panel/assets/js/examples/charts.js"></script>
<!-- end::chart -->

<!-- begin::swiper -->
<script src="/panel/assets/vendors/swiper/swiper.min.js"></script>
<script src="/panel/assets/js/examples/swiper.js"></script>
<!-- end::swiper -->

<!-- begin::custom scripts -->
<script src="/panel/assets/js/custom.js"></script>
<script src="/panel/assets/js/app.js"></script>
<!-- end::custom scripts -->
@yield('js')
</body>
</html>
