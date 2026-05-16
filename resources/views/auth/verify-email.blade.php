{{-- resources/views/auth/verify-email.blade.php --}}
{{-- Email verification notice for myrtcat site --}}

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Myrtcat') }} | Verify Email</title>

    {{-- Tailwind CSS via CDN (or use your compiled assets) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Optional custom styles --}}
    <style>
        .cat-paw { background-color: #f7f0e6; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 cat-paw">
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    {{-- Image Logo at the top --}}
    <div class="mb-6">
        {{-- Replace 'images/myrtcat-logo.png' with your actual logo path --}}
        <img src="{{ asset('public/user/img/login/1733810127.webp') }}" alt="Myrtcat Logo" class="h-16 mx-auto">
    </div>

    {{-- Full width card --}}
    <div class="w-75 px-6 py-8 bg-white shadow-lg rounded-lg">
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-amber-800">Verify your email</h2>
            <p class="text-sm text-gray-600 mt-2">
                Thanks for joining Myrtcat! Please verify your email address to continue.
            </p>
        </div>

        {{-- Status message (from session) --}}
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 border-l-4 border-green-400 p-3">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="text-sm text-gray-700 leading-relaxed">
            <p class="mb-4">
                Before proceeding, please check your email for a verification link.
                If you did not receive the email, click the button below to request another.
            </p>
        </div>

        {{-- Resend verification email only (logout button removed) --}}
        <div class="mt-6">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full py-2 px-4 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2">
                    Resend Verification Email
                </button>
            </form>
        </div>
    </div>

    {{-- Footer with a cute cat note --}}
    <div class="mt-4 text-center text-xs text-gray-500">
        <p>&copy; {{ date('Y') }} Myrtcat. All rights reserved. 🐱</p>
    </div>
</div>
</body>
</html>
