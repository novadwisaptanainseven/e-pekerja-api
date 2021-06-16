<?php

// Export Cuti by Id Pegawai to Excel

use App\Http\Controllers\Admin\CutiController;
use App\Http\Controllers\FileController;

Route::get('cuti-pegawai/{id}/export', [CutiController::class, "exportCutiToExcel"]);

// Cetak Riwayat Cuti
Route::get('print-riwayat-cuti/{id_pegawai}', [FileController::class, "cetakRiwayatCuti"]);
