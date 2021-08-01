<?php

// Export Pensiun Pegawai to Excel

use App\Http\Controllers\Admin\PensiunController;
use App\Http\Controllers\FileController;

Route::get('pensiun-pegawai/export', [PensiunController::class, "exportPensiunToExcel"]);

// Cetak Pensiun Pegawai
Route::get('print-pensiun-pegawai', [FileController::class, "cetakPensiunPegawai"]);
