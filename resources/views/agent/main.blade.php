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
    <script src="{{ asset('admin/assets/js/layout.js') }}"></script>
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">
    {{-- datatable assets--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
<style>
    @media screen and (min-width: 768px) {
        #DataTables_Table_0_length {
            display: inline !important;
            margin-left: 10px !important;
            margin-bottom: 10px !important;
        }
        div.dataTables_wrapper div.dataTables_filter label {
            margin-left: 125px !important;
            margin-bottom : 10px !important;
        }
        div.dataTables_wrapper div.dataTables_length label {
            margin-left: 30px !important;
            margin-bottom: 10px !important;
        }
    }

    div.dt-buttons {
        position: relative;
        float: left;
        margin-bottom: 10px;
        justify-content: space-between;
    }
    #DataTables_Table_0_filter {
        display: inline !important;
        float: inline-end !important;
        margin-bottom: 10px !important;
    }
    div.dataTables_wrapper div.dataTables_info {
        display: block !important;
        padding-top: 8px;
        white-space: nowrap;
    }
    div.dataTables_wrapper div.dataTables_length {
        display: block !important;
    }
    #c-pills-layouts-tab {
        display:none !important;
    }

    td {
        font-size: 13px !important;
    }

    .text-danger {
        font-size: 12px !important
    }
</style>
    @yield('style')


</head>
<body>
<!-- Begin page -->
<div id="layout-wrapper">
<!-- header page -->
@include('agent.components.header')
<!-- header page -->
@include('agent.components.sidebar')
    <div class="main-content">
        <!-- Start right Content here -->
        @yield('content')
        <!-- Page-footer -->
        @include('agent.components.footer')
        <!-- end main content-->
    </div>
</div>
<!-- End Main wrapper -->

<!-- JAVASCRIPT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/plugins.js') }}"></script>
<script src="{{ asset('admin/assets/libs/list.js/list.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
{{-- datatables asstets  --}}
<script src="{{asset('admin/assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/tables/datatable/buttons.bootstrap5.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/tables/datatable/jszip.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('admin/assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')}}"></script>

<script src="{{ asset('admin/assets/libs/toastify-js/src/toastify.js') }}"></script>
<script src="{{ asset('admin/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('admin/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/app.js') }}"></script>
@yield('script')


<script>
    var forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var submitButton = form.querySelector('button[type="submit"]');
            var originalText = submitButton.innerText; // Store the original text
            var $button = $(submitButton);
            $($button).html(`
                <span class="text-light">processing...</span>
                <span class="text-end text-light spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
            );
            submitButton.disabled = true;
            setTimeout(function() {
                form.submit();
            }, 1000);
            setTimeout(function() {
                $($button).html(originalText);
                submitButton.disabled = false;
            }, 3000);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#DataTables_Table_0').DataTable({
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.childRowImmediate,
                    type: ''
                }
            },
            ordering: false, // Disable sorting
            dom: 'lBfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                }
            ],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            pageLength: 10,
        });
    });

    //error message hide
    setTimeout(function() {
        $('.error').hide();
    }, 5000);
</script>

</body>
</html>
