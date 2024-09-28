<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DownloadPdfController;

Route::get('/', function () {
    return redirect('/admin/login');
});

Route::get('/incident-report/{record}', [DownloadPdfController::class, 'incidentReport'])->name('incident.report');
Route::get('/keluarga-report/{record}', [DownloadPdfController::class, 'keluargaReport'])->name('keluarga.report');