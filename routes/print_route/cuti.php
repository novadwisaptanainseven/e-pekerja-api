<?php

// Export Cuti by Id Pegawai to Excel

use App\Http\Controllers\Admin\CutiController;
use App\Http\Controllers\FileController;

// Export Riwayat Cuti
Route::get('cuti-pegawai/{id}/export', [CutiController::class, "exportCutiToExcel"]);

// Export Pegawai Status Cuti
Route::get('pegawai-status-cuti/export', [CutiController::class, "exportPegawaiStatusCuti"]);

// Cetak Riwayat Cuti
Route::get('print-riwayat-cuti/{id_pegawai}', [FileController::class, "cetakRiwayatCuti"]);

// Cetak Pegawai Status Cuti
Route::get('print-pegawai-status-cuti', [FileController::class, "cetakPegawaiStatusCuti"]);
