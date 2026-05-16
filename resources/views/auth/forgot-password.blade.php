@extends('user.layouts.master',[
    'title' => '| Forgot Password'
])
@section('main-content')
    <main class="main_wrapper overflow-hidden">
        <div class="aboutarea__5 sp_bottom_100 sp_top_100">
            <div class="container">
                <div class="col-xl-6 col-md-8 offset-md-2 offset-xl-3">
                    <div class="loginarea__wraper">
                        <div class="login__heading">
                            <h5 class="login__title">Forgot Password</h5>
                            <p class="login__description">Enter your email address and we'll send you a link to reset your password.</p>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success" style="text-align: center; margin-bottom: 20px;">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" style="text-align: center; margin-bottom: 20px;">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="login__form">
                                <label class="form__label">Email Address</label>
                                <input class="common__login__input" name="email" type="email"
                                       value="{{ old('email') }}" placeholder="Enter your email address">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="login__button">
                                <button type="submit" class="default__button">Send Reset Link</button>
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
