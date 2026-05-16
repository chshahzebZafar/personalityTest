@extends('user.layouts.master',[
    'title' => '| Reset Password'
])
@section('main-content')
    <main class="main_wrapper overflow-hidden">
        <div class="aboutarea__5 sp_bottom_100 sp_top_100">
            <div class="container">
                <div class="col-xl-6 col-md-8 offset-md-2 offset-xl-3">
                    <div class="loginarea__wraper">
                        <div class="login__heading">
                            <h5 class="login__title">Reset Password</h5>
                            <p class="login__description">Enter your new password below.</p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger" style="text-align: center; margin-bottom: 20px;">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="login__form">
                                <label class="form__label">Email Address</label>
                                <input class="common__login__input" name="email" type="email"
                                       value="{{ old('email', $email ?? '') }}" placeholder="Enter your email address">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="login__form">
                                <label class="form__label">New Password</label>
                                <input class="common__login__input" name="password" type="password"
                                       placeholder="Enter new password (min 6 characters)">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="login__form">
                                <label class="form__label">Confirm New Password</label>
                                <input class="common__login__input" name="password_confirmation" type="password"
                                       placeholder="Re-enter new password">
                            </div>

                            <div class="login__button">
                                <button type="submit" class="default__button">Reset Password</button>
                            </div>
                        </form>

                        <div style="text-align: center; margin-top: 20px;">
                            <a href="{{ route('login') }}" class="backhome">&larr; Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
