<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileAssessmentTestController;
use Illuminate\Http\Request;

Route::get('/', [ProfileAssessmentTestController::class,'ProfileAssessmentTest'])
->name('attemptTest');

Route::get('register',[RegisterController::class,'showRegistrationForm'])->name('register');

Route::post('submit-register',[RegisterController::class,'submitRegistration'])->name('user.register_post');

Route::get('login',[LoginController::class,'showLoginForm'])->name('login');

Route::post('submit-login',[LoginController::class,'loginPost'])->name('post_login');

// Forgot Password
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/email/verify/{id}/{hash}',
    [VerifyEmailController::class, 'verify']
)->middleware(['auth:candidate', 'signed'])
    ->name('verification.verify');

Route::middleware(['auth:candidate', 'verified'])->group(function () {

    Route::post('submit-test',[ProfileAssessmentTestController::class,'submitTest'])
        ->name('assessment.auto.submit');

    Route::get('tests-list',[HomeController::class,'testList'])
        ->name('assessment.test.list');

    Route::get('download-result/{quiz_id}',[ResultController::class,'downloadResult'])
        ->name('assessment.test.download.result');

    Route::get('payment-success',[HomeController::class,'paymentSuccess'])->name('user.paymentSuccess');

    Route::get('payment-checkout',[HomeController::class,'paymentCheckout'])->name('user.paymentCheckout');

    Route::get('payment-failed',[HomeController::class,'paymentFailed'])->name('user.paymentFailed');

    // Route::get('/dashboard', function () {
    //     return view('user.dashboard');
    // })->name('user.dashboard');

    Route::get('/logout', [HomeController::class,'logout'])->name('candidate.logout');

    Route::get('payment-history', [HomeController::class, 'paymentHistory'])->name('candidate.payment.history');

});

Route::get('/email/verify', function () {
    return view('auth.verify-email'); // apni view banayein
})->middleware('auth:candidate')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    try {
        $request->user('candidate')->sendEmailVerificationNotification();
        return back()->with('success', 'Verification link sent! Please check your email.');
    } catch (\Exception $e) {
        \Log::error('Failed to send verification email: ' . $e->getMessage());
        return back()->with('error', 'Unable to send email. Please contact support or try again later.');
    }
})->middleware(['auth:candidate', 'throttle:6,1'])
    ->name('verification.send');
