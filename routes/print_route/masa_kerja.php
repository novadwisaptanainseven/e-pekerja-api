<?php

// Export Masa Kerja Pegawai to Excel

use App\Http\Controllers\Admin\MasaKerjaController;
use App\Http\Controllers\FileController;

Route::get('masa-kerja/export', [MasaKerjaController::class, "exportMasaKerjaToExcel"]);

// Export Excel Riwayat Masa Kerja
Route::get("riwayat-mk/{id_pegawai}/export", [MasaKerjaController::class, 'exportRiwayatMasaKerjaToExcel']);

// Cetak Masa Kerja Pegawai
Route::get('print-masa-kerja-pegawai', [FileController::class, "cetakMasaKerja"]);

// Cetak PDF Riwayat Masa Kerja
Route::get("riwayat-mk-cetak/{id_pegawai}", [FileController::class, 'cetakRiwayatMasaKerja']);

// Simpan Riwayat Pegawai berdasarkan masa kerja
Route::post('riwayat-mk/save', [MasaKerjaController::class, "saveRiwayatMasaKerjaToExcel"]);

// Get Riwayat Pegawai File berdasarkan masa kerja
Route::get('riwayat-mk-file', [MasaKerjaController::class, "getRiwayatMasaKerjaFile"]);


// Hapus Riwayat Pegawai File berdasarkan masa kerja
Route::get('riwayat-mk-file/{id}/delete', [MasaKerjaController::class, "deleteRiwayatMasaKerjaFile"]);
