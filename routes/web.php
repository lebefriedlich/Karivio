<?php

use App\Http\Controllers\CvExportController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Cv\CvForm;
use App\Livewire\Cv\CvList;
use App\Livewire\Cv\CvPreview;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\FileManagement;
use App\Livewire\Pages\EmailList;
use App\Livewire\Pages\SendEmail;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\GoogleController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name('login');

    // Google Auth Routes
    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/oauth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/file-management', FileManagement::class)->name('file-management');
    Route::get('/email', EmailList::class)->name('email.list');
    Route::get('/send-email/{type?}/{id?}', SendEmail::class)->name('send-email');
    Route::get('/cv', CvList::class)->name('cv.list');
    Route::get('/cv/{cvId}/preview', CvPreview::class)->name('cv.preview');
    Route::get('/cv-form/{cvId?}', CvForm::class)->name('cv.form');
    Route::get('/cv/{cv}/export-pdf', [CvExportController::class, 'exportPdf'])->name('cv.export-pdf');

    // Cover Letter Routes
    Route::get('/cover-letters', \App\Livewire\CoverLetter\CoverLetterList::class)->name('cover-letter.list');
    Route::get('/cover-letters/create/{id?}', \App\Livewire\CoverLetter\CoverLetterForm::class)->name('cover-letter.form');
    Route::get('/cover-letters/preview/{id}', \App\Livewire\CoverLetter\CoverLetterPreview::class)->name('cover-letter.preview');
    Route::get('/cover-letter/{cl}/export-pdf', [CvExportController::class, 'exportCoverLetterPdf'])->name('cover-letter.export-pdf');

    Route::post('/logout', function () {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
