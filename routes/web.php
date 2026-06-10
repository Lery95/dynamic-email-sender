<?php

use App\Http\Controllers\CertificateController;

Route::get('/certificates', [
    CertificateController::class,
    'index'
]);

Route::post('/certificates', [
    CertificateController::class,
    'upload'
])->name('certificate.upload');

Route::get('/test-mail', function () {

    Mail::raw('Test Email', function ($message) {
        $message->to('lerryson@plixstar.com')
            ->subject('Laravel Test');
    });

    return 'sent';
});