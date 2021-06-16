<?php

// Export Riwayat SK Pegawai to Excel

use App\Http\Controllers\Admin\PembaruanSKController;
use App\Http\Controllers\FileController;

Route::get('riwayat-sk/{id_pegawai}/export', [PembaruanSKController::class, "exportRiwayatSK"]);

// Cetak Riwayat SK
Route::get('print-riwayat-sk/{id_pegawai}', [FileController::class, "cetakRiwayatSK"]);
