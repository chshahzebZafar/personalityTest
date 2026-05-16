@extends('user.layouts.master',[
    'title' => ' | MentalClarity | Register'
])
@section('main-content')
    <main class="main_wrapper overflow-hidden">

        <div class="aboutarea__5 sp_bottom_100 sp_top_100">
            <div class="container">
                <!--<div class="row">-->
                <!--    <div class="col-xl-5 col-lg-5 aos-init aos-animate login-bg" data-aos="fade-up">-->
                <!--        <div class="aboutarea__5__img" data-tilt="">-->
                <!--            <img loading="lazy" src="{{ asset('public/user/img/login/login-img.png') }}" alt="login"-->
                <!--                 width="400">-->
                <!--        </div>-->
                <!--        <br>-->
                <!--        <div class="section__title__heading" style="text-align: center;">-->
                <!--            <h2 style="font-size: 27px;">Welcome to {{ config('settings.site_detail.company_name') }}</h2>-->
                <!--        </div>-->
                <!--        <br><br>-->

                <!--    </div>-->

                <!--    <div class="col-xl-7 col-lg-7 aos-init aos-animate" data-aos="fade-up">-->
                        <div class="tab-pane fade active show" id="projects__one" role="tabpanel"
                             aria-labelledby="projects__one">

                            <div class="col-xl-12">
                                <div class="img-logo" style="    margin: -40px 0px 10px 0px;">
                                    <img style="width: 100px;"
                                         src="{{ asset('public/user/img/login/1733810127.webp') }}" class="img-fluid"
                                         alt="Logo">
{{--                                    <div class="back-home" style="    text-align: right;     margin-top: -34px;">--}}
{{--                                        <a href="{{ route('user.index') }}" class="backhome">Back to Home</a>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="loginarea__wraper">
                                    <div class="login__heading">
                                        <h5 class="login__title">Sign Up</h5>
                                        <p class="login__description">Already have an account? <a
                                                href="{{ route('login') }}" class="backhome">Log In</a></p>
                                    </div>

                                    <form action="{{ route('user.register_post') }}" id="registrationForm" method="post">
                                        @csrf
                                        <div class="row" id="personal-info-fields">
                                            <div class="col-xl-6">
                                                <div class="login__form">
                                                    <label class="form__label">Full Name</label>
                                                    <input class="common__login__input" name="full_name"
                                                           value="{{ old('full_name') }}" type="text"
                                                           placeholder="Enter Full name">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="login__form">
                                                    <label class="form__label">Email</label>
                                                    <input class="common__login__input" name="email"
                                                           value="{{ old('email') }}" type="email" placeholder="Your Email">

                                                </div>
                                            </div>


                                            <div class="col-xl-6">
                                                <div class="login__form">
                                                    <label class="form__label">Password</label>
                                                    <input class="common__login__input" name="password" id="password"
                                                           type="password" placeholder="Password">

                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="login__form">
                                                    <label class="form__label">Re-Enter Password</label>
                                                    <input class="common__login__input" name="password_confirmation"
                                                           type="password" placeholder="Re-Enter Password">
                                                </div>
                                            </div>
                                        </div>

{{--                                        <div class="login__form d-flex justify-content-between flex-wrap gap-2">--}}
{{--                                            <div class="form__check">--}}
{{--                                                <input id="accept_pp" name="terms_and_condition" type="checkbox">--}}
{{--                                                <label for="accept_pp">Accept the --}}
{{--                                                    <a--}}
{{--                                                        href="{{ route('user.terms-conditions') }}" target="_blank"--}}
{{--                                                        rel="noopener noreferrer">Terms</a> and <a--}}
{{--                                                        href="{{ route('user.privacy-policy') }}" target="_blank"--}}
{{--                                                        rel="noopener noreferrer">Privacy Policy</a></label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="login__form d-flex justify-content-between flex-wrap gap-2">
                                            <div class="form__check">
                                                <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}">
                                                </div>
                                                @if ($errors->has('g-recaptcha-response'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="login__button">
                                            <button class="default__button" href="#">Register Now</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    <!--</div>-->
                </div>
            </div>
        </div>
    </main>
    @push('css')
        <style>
            label.error {
                color: red !important;
            }
        </style>
    @endpush
    @push('js')
        <script src="{{ asset('public/user/js/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/toastr.js') }}"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="{{ asset('public/assets/js/jquery.validate.min.js') }}"></script>
        <script>
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

            // Cookie helper function
            function getCookie(name) {
                const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
                return match ? decodeURIComponent(match[2]) : null;
            }

            $(document).ready(function () {
                // Initialize validation without first_name, last_name, phone_number rules
                $("#registrationForm").validate({
                        rules: {
                            email: {
                                required: true,
                                email: true
                            },
                            password: {
                                required: true,
                                minlength: 6
                            },
                            password_confirmation: {
                                required: true,
                                equalTo: "#password"
                            },
                            terms_and_condition: "required"
                        },
                        messages: {
                            email: "Please enter a valid email address",
                            password: {
                                required: "Please enter a password",
                                minlength: "Password must be at least 6 characters"
                            },
                            password_confirmation: {
                                required: "Please confirm your password",
                                equalTo: "Passwords do not match"
                            },
                            terms_and_condition: "You must accept the terms and privacy policy"
                        }
                    });
            });
        </script>
    @endpush
@endsection
