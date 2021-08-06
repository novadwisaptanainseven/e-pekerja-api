<?php

use App\Http\Controllers\Admin\Pegawai\RiwayatKerjaController;

// Get All Riwayat Kerja
Route::get("{id_pegawai}/riwayat-kerja", [RiwayatKerjaController::class, 'getAll']);
// Get Riwayat Kerja By ID
Route::get("{id_pegawai}/riwayat-kerja/{id_riwayat_kerja}", [RiwayatKerjaController::class, 'getById']);
// Insert Riwayat Kerja
Route::post("{id_pegawai}/riwayat-kerja", [RiwayatKerjaController::class, 'insert']);
// Edit Riwayat Kerja
Route::put("{id_pegawai}/riwayat-kerja/{id_riwayat_kerja}", [RiwayatKerjaController::class, 'edit']);
// Delete Riwayat Kerja
Route::delete("{id_pegawai}/riwayat-kerja/{id_riwayat_kerja}", [RiwayatKerjaController::class, 'delete']);
