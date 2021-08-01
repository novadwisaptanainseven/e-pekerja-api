<?php

// GROUP MASA KERJA

use App\Http\Controllers\Admin\MasaKerjaController;

// Edit Masa Kerja
Route::put("masa-kerja/{id_masa_kerja}", [MasaKerjaController::class, 'edit']);
// Get All Masa Kerja
Route::get("masa-kerja", [MasaKerjaController::class, 'getAll']);
// Get All Masa Kerja For Print
Route::get("masa-kerja-pegawai-print", [MasaKerjaController::class, 'getAllForPrint']);
// Get Masa Kerja By Id
Route::get("masa-kerja/{id_masa_kerja}", [MasaKerjaController::class, 'getById']);
// Insert Riwayat Masa Kerja
Route::post("/pegawai/{id_pegawai}/masa-kerja/riwayat", [MasaKerjaController::class, 'insertRiwayatMasaKerja']);
// Get All Riwayat Masa Kerja
Route::get("/pegawai/{id_pegawai}/masa-kerja/riwayat", [MasaKerjaController::class, 'getAllRiwayatMasaKerja']);
// Get Riwayat Masa Kerja By ID
Route::get("/pegawai/{id_pegawai}/masa-kerja/riwayat/{id}", [MasaKerjaController::class, 'getRiwayatMasaKerjaById']);
// Get Riwayat Masa Kerja Terbaru
Route::get("/pegawai/{id_pegawai}/masa-kerja/riwayat-terakhir", [MasaKerjaController::class, 'getRiwayatMasaKerjaTerbaru']);
// Delete Riwayat Masa Kerja
Route::delete("/pegawai/{id_pegawai}/masa-kerja/riwayat/{id}", [MasaKerjaController::class, 'deleteRiwayatMasaKerja']);

