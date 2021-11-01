<?php


use App\Http\Controllers\Admin\PembaruanSKController;

// Get All Riwayat SK
Route::get("{id_pegawai}/riwayat-sk", [PembaruanSKController::class, 'getAll']);

// Insert Riwayat SK
Route::post("{id_pegawai}/riwayat-sk", [PembaruanSKController::class, 'insert']);

// Edit Riwayat SK By ID
Route::post("{id_pegawai}/riwayat-sk/{id}", [PembaruanSKController::class, 'edit']);

// Get Riwayat SK By Id
Route::get("{id_pegawai}/riwayat-sk/{id}", [PembaruanSKController::class, 'getById']);

// Delete Riwayat SK By Id
Route::get("{id_pegawai}/riwayat-sk/{id}/delete", [PembaruanSKController::class, 'deleteRiwayatSK']);

