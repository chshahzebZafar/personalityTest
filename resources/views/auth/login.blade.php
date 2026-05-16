@extends('user.layouts.master',[
    'title' => ' | MentalClarity | Login'
])
@section('main-content')
    <main class="main_wrapper overflow-hidden">

        <div class="aboutarea__5 sp_bottom_100 sp_top_100">
            <div class="container">
                <!--<div class="row">-->
                <!--    <div class="col-xl-6 col-lg-6 aos-init aos-animate login-bg" data-aos="fade-up">-->
                <!--        <div class="aboutarea__5__img" data-tilt="">-->
                <!--            <img loading="lazy" src="{{ asset('public/user/img/login/login-img.png') }}" alt="login"-->
                <!--                width="400">-->
                <!--        </div>-->
                <!--        <br>-->
                <!--        <div class="section__title__heading" style="text-align: center;">-->
                <!--            <h2 style="font-size: 27px;">Welcome to RTCat MentalClarity</h2>-->
                <!--        </div>-->
                <!--        <br><br>-->

                <!--    </div>-->

                <!--    <div class="col-xl-6 col-lg-6 aos-init aos-animate" data-aos="fade-up">-->
                        <div class="tab-pane fade active show" id="projects__one" role="tabpanel"
                            aria-labelledby="projects__one">

                            <div class="col-xl-10 col-md-8 offset-md-2">
                                <div class="img-logo" style="    margin: -40px 0px 40px 0px;">
                                    <img style="width: 100px;"
                                        src="{{ asset('public/user/img/login/1733810127.webp') }}"
                                        class="img-fluid" alt="Logo">
                                    <div class="back-home" style="    text-align: right;     margin-top: -34px;">
                                        <a href="https://myrtcat.com/" class="backhome">Back to Home</a>
                                    </div>
                                </div>
                                <div class="loginarea__wraper">
                                    @if (session('status'))
                                        <div class="alert alert-success" style="text-align: center;">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @if (session('verified'))
                                        <div class="alert alert-success" style="text-align: center;">
                                            {{ session('verified') }}
                                        </div>
                                    @endif
                                    <div class="login__heading">
                                        <h5 class="login__title">Login</h5>
                                        <p class="login__description">Don't have an account yet? <a
                                                href="{{ route('register') }}" class="backhome">Sign up </a></p>
                                    </div>

                                    <form action="{{ route('post_login') }}" method="post">
                                        @csrf
                                        <div class="login__form">
                                            <label class="form__label">Email</label>
                                            <input class="common__login__input" name="email" type="email"
                                                placeholder="Enter Email">

                                        </div>
                                        <div class="login__form">
                                            <label class="form__label">Password</label>
                                            <input class="common__login__input" name="password" type="password"
                                                placeholder="Enter Your Password">
                                        </div>
                                        <div class="login__form d-flex justify-content-between flex-wrap gap-2">
                                            <div class="form__check">
                                                <input id="forgot" type="checkbox">
                                                <label for="forgot"> Remember me</label>
                                            </div>
                                            <div class="text-end login__form__link">
                                                <a href="{{ route('password.request') }}">Forgot your password?</a>
                                            </div>
                                        </div>
                                        <div class="login__form">
                                            {{-- <div class="form-group">--}}
                                                {{-- <div class="g-recaptcha" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}">
                                                </div>--}}
                                                {{-- @if ($errors->has('g-recaptcha-response'))--}}
                                                {{-- <span class="text-danger">{{ $errors->first('g-recaptcha-response')
                                                    }}</span>--}}
                                                {{-- @endif--}}
                                                {{-- </div> --}}
                                        </div>


                                        <div class="login__button">
                                            <button class="default__button" href="#">Log In</button>
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
    @push('js')
        <script src='https://www.google.com/recaptcha/api.js'></script>
    @endpush
@endsection
