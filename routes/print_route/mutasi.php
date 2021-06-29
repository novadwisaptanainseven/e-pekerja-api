<?php

use App\Http\Controllers\Admin\Pegawai\MutasiController;
use App\Http\Controllers\FileController;

Route::get('mutasi-pegawai/export', [MutasiController::class, "exportMutasiToExcel"]);

// Cetak Mutasi Pegawai
Route::get('print-mutasi-pegawai', [FileController::class, "cetakMutasiPegawai"]);
