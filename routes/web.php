<?php

use App\Http\Controllers\BulkEmailController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Mailer\Test\Constraint\EmailCount;
use App\Http\Controllers\CookieConsentController;
use App\Http\Controllers\ConsentController;

Route::get('/', function () {
    return view('welcome');
});




Route::get('/send-bulk-email', [BulkEmailController::class, 'sendBulkEmail']);

Route::get('cookie-consent', [CookieConsentController::class, 'showConsentForm'])->name('cookie-consent.show');
Route::post('cookie-consent', [CookieConsentController::class, 'storeConsent'])->name('cookie-consent.store');

// routes/web.php
Route::get('/consent/manage', [ConsentController::class, 'index'])->name('consent.manage');
Route::post('/consent/save', [ConsentController::class, 'save'])->name('consent.save');
