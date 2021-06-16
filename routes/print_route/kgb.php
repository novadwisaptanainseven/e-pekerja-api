<?php

// Export KGB by Id Pegawai to Excel

use App\Http\Controllers\Admin\KGBController;
use App\Http\Controllers\FileController;

Route::get('kgb-pegawai/{id}/export', [KGBController::class, "exportKgbToExcel"]);

// Cetak KGB Pegawai
Route::get('print-kgb-pegawai/{id_pegawai}', [FileController::class, "cetakKGBPegawai"]);
