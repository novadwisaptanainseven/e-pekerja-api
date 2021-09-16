<?php


use App\Http\Controllers\Admin\PegawaiBerhentiController;
use App\Http\Controllers\FileController;

// Export Pegawai Berhenti to Excel
Route::get('pegawai-berhenti/export', [PegawaiBerhentiController::class, "exportPegawaiBerhentiToExcel"]);

// Cetak Pegawai Berhenti Pegawai
Route::get('print-pegawai-berhenti', [FileController::class, "cetakPegawaiBerhenti"]);
