<?php

// Export KGB by Id Pegawai to Excel

use App\Http\Controllers\Admin\KGBController;
use App\Http\Controllers\FileController;

// Export KGB Pegawai ke Excel
Route::get('kgb-pegawai/{id}/export', [KGBController::class, "exportKgbToExcel"]);

// Export KGB Pegawai 2 ke Excel
Route::get('kgb-pegawai2/export', [KGBController::class, "exportKgbToExcel2"]);

// Cetak KGB Pegawai
Route::get('print-kgb-pegawai/{id_pegawai}', [FileController::class, "cetakKGBPegawai"]);

// Cetak KGB Pegawai 2
Route::get('print-kgb', [FileController::class, "cetakKGBPegawai2"]);
