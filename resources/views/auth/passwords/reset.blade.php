@extends('user.layouts.master')
@section('main-content')
    <main class="main_wrapper overflow-hidden">

        <div class="aboutarea__5 sp_bottom_100 sp_top_100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 aos-init aos-animate login-bg" data-aos="fade-up">
                        <div class="aboutarea__5__img" data-tilt="">
                            <img loading="lazy" src="{{ asset('public/user/img/login/login-img') }}.png" alt="login"
                                width="400">
                        </div>
                        <br>
                        <div class="section__title__heading" style="text-align: center;">
                            <h2 style="font-size: 27px;">Welcome to {{ config('settings.site_detail.company_name') }}</h2>
                        </div>
                        <br><br>

                    </div>

                    <div class="col-xl-6 col-lg-6 aos-init aos-animate" data-aos="fade-up">
                        <div class="tab-pane fade active show" id="projects__one" role="tabpanel"
                            aria-labelledby="projects__one">
                            <div class="img-logo" style="    margin: -21px 0px 40px 0px;">
                                <img style="width: 140px;"
                                    src="{{ asset(config('settings.site_detail.company_logo')) ?? asset('public/user/img/logo/logo_1.png') }}"
                                    class="img-fluid" alt="Logo">
                                <div class="back-home" style="    text-align: right;     margin-top: -34px;">
                                    <a href="https://myrtcat.com/" class="backhome">Back to Home</a>
                                </div>
                            </div>
                            <div class="loginarea__wraper">
                                <div class="login__heading">
                                    <h5 class="login__title">Reset Your password</h5>
                                    <p class="login__description">Don't have an account yet? <a
                                            href="{{ route('user.register') }}" class="backhome">Sign up </a></p>
                                </div>
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                                    <div class="row mb-3">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password-confirm"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Reset Password') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection