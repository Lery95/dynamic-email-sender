<?php

use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;

Route::get('/certificates', [
    CertificateController::class,
    'index'
]);

Route::post('/certificates', [
    CertificateController::class,
    'upload'
])->name('certificate.upload');

Route::get('/signature', function () {
    return view('plixstar-signature');
});