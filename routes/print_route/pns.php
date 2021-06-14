<?php

// Export PNS to Excel
Route::get('pns/export', [PNSController::class, "exportToExcel"]);

// Export Semua Pegawai to Excel
Route::get('semua-pegawai/export', [PNSController::class, "exportAllPegawaiToExcel"]);

// Export Rekapitulasi Pegawai to Excel
Route::get('rekap-pegawai/export', [PNSController::class, "exportRekapPegawaiToExcel"]);
