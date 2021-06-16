<?php

// Export Absensi to Excel

use App\Http\Controllers\Admin\Pegawai\AbsensiController;
use App\Http\Controllers\FileController;

Route::get('absensi-pegawai/{jenis}/export', [AbsensiController::class, "exportAbsensiToExcel"]);

// Export Absensi Per Tahun to Excel
Route::get('absensi-per-tahun/{id}/export', [AbsensiController::class, "exportAbsensiPerTahunToExcel"]);

// Export Absensi by Filter Tanggal to Excel
Route::get('absensi-filter-tanggal/{id}/export', [AbsensiController::class, "exportAbsensiByFilterTanggalToExcel"]);

// Export Rekap Absensi Semua Pegawai to Excel
Route::get('rekap-absensi-semua-pegawai/{filter}/export', [AbsensiController::class, "exportAbsensiSemuaPegawaiPerTahun"]);

// Cetak Rekap Absensi Pegawai
Route::get('print-rekap-absensi/{jenis_data}', [FileController::class, "cetakRekapAbsensi"]);

// Cetak Rekap Absensi Pegawai berdasarkan tanggal
Route::get('print-rekap-absensi-tanggal/{jenis_data}', [FileController::class, "cetakRekapAbsensiByDate"]);

// Cetak Rekap Absensi Pegawai berdasarkan filter tanggal
Route::get('print-rekap-absensi-filter/{id_pegawai}', [FileController::class, "cetakRekapAbsensiByFilterTanggal"]);

// Cetak Rekap Absensi Per Tahun by Id Pegawai
Route::get('print-rekap-absensi-pegawai/{id_pegawai}', [FileController::class, "cetakRekapAbsensiPerTahun"]);
