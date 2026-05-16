<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('settings.company_name') }} {{ $title ?? '' }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('settings.company_logo')) ?? asset('public/user/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/aos.min.css') }}/">
    <link rel="stylesheet" href="{{ asset('public/user/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/icofont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/font-icons/font-awesome/css/font-awesome.min.css') }}">

    @stack('css')
    <!--<script>-->
        <!--// On page load or when changing themes, best to add inline in `head` to avoid FOUC-->
    <!--    if (localStorage.getItem("theme-color") === "dark" || (!("theme-color" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches)) {-->
    <!--        document.documentElement.classList.add("is_dark");-->
    <!--    }-->
    <!--    if (localStorage.getItem("theme-color") === "light") {-->
    <!--        document.documentElement.classList.remove("is_dark");-->
    <!--    }-->
    <!--</script>-->

</head>


<body class="body__wrapper">

<!-- pre loader area start -->
<div id="back__preloader">
    <div id="back__circle_loader"></div>
    <div class="back__loader_logo">
        <img loading="lazy"  src="{{ asset('public/user/img/pre.png') }}" alt="Preload">
    </div>
</div>
@yield('main-content')
<!-- JS here -->
<script src="{{ asset('public/user/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<script src="{{ asset('public/user/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('public/assets/js/toastr.js') }}"></script>
<script src="{{ asset('public/user/js/popper.min.js') }}"></script>
<script src="{{ asset('public/user/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/user/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('public/user/js/slick.min.js') }}"></script>
<script src="{{ asset('public/user/js/jquery.meanmenu.min.js') }}"></script>
<script src="{{ asset('public/user/js/ajax-form.js') }}"></script>
<script src="{{ asset('public/user/js/wow.min.js') }}"></script>
<script src="{{ asset('public/user/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('public/user/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('public/user/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('public/user/js/waypoints.min.js') }}"></script>
<script src="{{ asset('public/user/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('public/user/js/plugins.js') }}"></script>
<script src="{{ asset('public/user/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('public/user/js/main.js') }}"></script>
<script src="{{ asset('public/assets/js/toastr.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var opts = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}","Success", opts);
        @endif


        @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}","Info", opts);
        @endif


        @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}","Warning",opts);
        @endif
        @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}","Error",opts);
        @endif
            @if (isset($errors) && $errors->any())
    @foreach ($errors->all() as $error)
        toastr["error"]('{{ $error }}');
    @endforeach
@endif

    });
</script>
@if(Auth::check())
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const assessmentData = localStorage.getItem('profile_assessment_test_responses');

            // ✅ If no data → do nothing
            if (!assessmentData) {
                return;
            }

            // ✅ Prevent duplicate submission in same tab
            if (sessionStorage.getItem('assessment_sync_in_progress')) {
                return;
            }

            sessionStorage.setItem('assessment_sync_in_progress', 'true');

            fetch("{{ route('assessment.auto.submit') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    assessment_responses: assessmentData
                })
            })
                .then(response => response.json())
                .then(data => {

                    if (data.status === true) {

                        // ✅ Clear localStorage after successful save
                        localStorage.removeItem('profile_assessment_test_responses');

                        console.log("Assessment auto-synced successfully");

                    } else {
                        console.log("Auto sync failed:", data.message);
                    }

                    sessionStorage.removeItem('assessment_sync_in_progress');
                })
                .catch(error => {
                    console.error("Error:", error);
                    sessionStorage.removeItem('assessment_sync_in_progress');
                });

        });
    </script>
@endif
@stack('js')
</body>
</html>
