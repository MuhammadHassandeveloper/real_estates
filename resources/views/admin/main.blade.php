<!doctype html>
<html lang="en" data-layout="vertical" data-sidebar="dark" data-sidebar-size="lg" data-preloader="disable" data-theme="default" data-topbar="light" data-bs-theme="light">


<head>

    <meta charset="utf-8">
    <title>{{ \App\Helpers\AppHelper::site_name() }} - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content=">{{ \App\Helpers\AppHelper::site_name() }}" name="{{ \App\Helpers\AppHelper::site_name() }}">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link id="fontsLink" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('admin/assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('admin/assets/js/layout.js') }}"></script>
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">
    @yield('style')
</head>
<body>
<!-- Begin page -->
<div id="layout-wrapper">
<!-- header page -->
@include('admin.components.header')

<!-- header page -->
@include('admin.components.sidebar')
<!-- Start right Content here -->
@yield('content')
<!-- Page-footer -->
@include('admin.components.footer')
<!-- end main content-->

</div>
<!-- End Main wrapper -->


<!-- JAVASCRIPT -->
<script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.js/list.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/pages/dashboard-real-estate.init.js') }}"></script>
<script src="{{ asset('admin/assets/js/app.js') }}"></script>
@yield('script')
</body>
</html>
