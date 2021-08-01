<?php

// Export PNS to Excel

use App\Http\Controllers\Admin\Pegawai\PNSController;

Route::get('pns/export', [PNSController::class, "exportToExcel"]);

// Export Semua Pegawai to Excel
Route::get('semua-pegawai/export', [PNSController::class, "exportAllPegawaiToExcel"]);

// Export Rekapitulasi Pegawai to Excel
Route::get('rekap-pegawai/export', [PNSController::class, "exportRekapPegawaiToExcel"]);

// Export Laporan Pegawai to Excel
Route::get('laporan-pegawai/{id_pegawai}/{data}/export', [PNSController::class, "exportLaporanPegawaiToExcel"]);

// Rekap Pegawai berdasarkan Golongan/Eselon/Pendidikan/Jenis Kelamin
Route::get('rekap-pegawai', [PNSController::class, "getRekapPegawai"]);
