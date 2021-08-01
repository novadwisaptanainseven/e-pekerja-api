<?php

use App\Http\Controllers\Admin\RiwayatGolonganController;
use App\Http\Controllers\FileController;

// Export Riwayat SK Pegawai to Excel
Route::get('riwayat-golongan/{id_pegawai}/export', [RiwayatGolonganController::class, "exportRiwayatGolongan"]);

// Cetak Riwayat Golongan
Route::get('print-riwayat-golongan/{id_pegawai}', [FileController::class, "cetakRiwayatGolongan"]);
