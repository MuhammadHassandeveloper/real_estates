<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{ App\Helpers\AppHelper::site_name() }} - @yield('title')</title>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet">
    <style>
        h4.modal-header-title {
            font-size: 2em !important;
        }
        .text-danger {
            display: flex;
            margin-top: 8px;
            font-size: 12px !important
        }
        .property-listing.property-1 .listing-name {
            font-size: 14px !important;
            margin-bottom: 2px;
        }
        .proerty_text .captlize {
            font-size: 14px !important;
        }
        span.tag_p {
            position: absolute;
            left: 15px;
            bottom: 20px;
            display: inline-block;
            padding: 7px 15px;
            background: #00ba74;
            border-radius: 4px;
            color: #fff;
        }
        .property_add {
            font-size: 14px !important;
        }

        .property-listing.property-1 .listing-location {
            font-size: 14px !important;
        }
        .inc-fleat {
            font-size: 12px !important;
        }
        .img-fluid {
            max-width: 100%;
            height: auto !important;
            max-height: 250px !important;
        }
    </style>
    @yield('style')
</head>

<body class="green-skin">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div id="preloader"><div class="preloader"><span></span><span></span></div></div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">

<!-- header page -->
@include('frontend.components.header')
<!-- Start right Content here -->
@yield('content')
<!-- Page-footer -->
@include('frontend.components.footer')
<!-- end main content-->

</div>
<!-- End Main wrapper -->

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/rangeslider.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.js') }}"></script>
<script src="{{ asset('assets/js/slider-bg.js') }}"></script>
<script src="{{ asset('assets/js/lightbox.js') }}"></script>
<script src="{{ asset('assets/js/imagesloaded.js') }}"></script>

<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/cl-switch.js') }}"></script>
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

    //error message hide
    setTimeout(function() {
        $('.error').hide();
    }, 5000);
</script>
</body>
</html>
