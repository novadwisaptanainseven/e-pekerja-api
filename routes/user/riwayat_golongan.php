<?php


use App\Http\Controllers\Admin\RiwayatGolonganController;

// Get all riwayat golongan by id pegawai
Route::get("{id_pegawai}/riwayat-golongan", [RiwayatGolonganController::class, "get"]);

// Get by id
Route::get("riwayat-golongan/{id}", [RiwayatGolonganController::class, "getById"]);

// Insert
Route::post("{id_pegawai}/riwayat-golongan", [RiwayatGolonganController::class, "create"]);

// Edit
Route::post("riwayat-golongan/{id}", [RiwayatGolonganController::class, "update"]);

// Update status terkini golongan
Route::post("{id_pegawai}/riwayat-golongan/{id}/status-terkini", [RiwayatGolonganController::class, "updateStatusTerkini"]);

// Delete
Route::get("riwayat-golongan/{id}/delete", [RiwayatGolonganController::class, "destroy"]);
