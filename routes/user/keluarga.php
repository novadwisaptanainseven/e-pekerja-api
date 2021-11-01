<?php


use App\Http\Controllers\Admin\Pegawai\KeluargaController;

// Get All Keluarga
Route::get("{id_pegawai}/keluarga", [KeluargaController::class, 'getAll']);
// Get Keluarga By ID

Route::get("{id_pegawai}/keluarga/{id_keluarga}", [KeluargaController::class, 'getById']);

// Insert Keluarga
Route::post("{id_pegawai}/keluarga", [KeluargaController::class, 'insert']);

// Edit Keluarga
Route::post("{id_pegawai}/keluarga/{id_keluarga}", [KeluargaController::class, 'edit']);

// Delete Keluarga
Route::get("{id_pegawai}/keluarga/{id_keluarga}/delete", [KeluargaController::class, 'delete']);
