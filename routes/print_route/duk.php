<?php

// Export DUK Pegawai to Excel

use App\Http\Controllers\Admin\DUKController;
use App\Http\Controllers\FileController;

Route::get('duk/export', [DUKController::class, "exportDukToExcel"]);

// Cetak DUK pegawai
Route::get('print-duk-pegawai', [FileController::class, "cetakDUK"]);
