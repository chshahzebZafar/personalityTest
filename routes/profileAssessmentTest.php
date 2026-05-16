<?php

use App\Http\Controllers\ProfileAssessmentTestController;
use Illuminate\Support\Facades\Route;

// Public: supports both guest preview and authenticated test-taking.
// The controller itself skips saving scores for unauthenticated users.
Route::post('profile-assessment-test/fetch-next-question', [ProfileAssessmentTestController::class, 'fetchNextQuestion'])
    ->name('profileAssessmentTest.fetch-next-question');

// Requires an authenticated, verified candidate session
Route::middleware(['auth:candidate', 'verified'])->group(function () {

    Route::get('profile-assessment-test/{quizId}', [ProfileAssessmentTestController::class, 'ProfileAssessmentTest'])
        ->name('user.profileAssessmentTest');

    Route::get('profile-assessment-result/{quizId}', [ProfileAssessmentTestController::class, 'editPdf'])
        ->name('user.profileAssessmentResult');

    Route::get('download-certificate', [ProfileAssessmentTestController::class, 'downloadImage'])
        ->name('user.downloadCertificate');

});
