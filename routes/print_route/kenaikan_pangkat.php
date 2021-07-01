<?php

use App\Http\Controllers\Admin\KenaikanPangkatController;
use App\Http\Controllers\FileController;

// Export to excel
Route::get('kenaikan-pangkat/export', [KenaikanPangkatController::class, "exportKenaikanPangkatToExcel"]);

// Cetak KenaikanPangkat Pegawai
Route::get('print-kenaikan-pangkat', [FileController::class, "cetakKenaikanPangkatPegawai"]);
