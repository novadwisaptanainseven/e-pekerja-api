<?php

// Get All Pendidikan

use App\Http\Controllers\Admin\Pegawai\PendidikanController;

Route::get("{id_pegawai}/pendidikan", [PendidikanController::class, 'getAll']);
// Get Pendidikan By ID
Route::get("{id_pegawai}/pendidikan/{id_pendidikan}", [PendidikanController::class, 'getById']);
// Insert Pendidikan
Route::post("{id_pegawai}/pendidikan", [PendidikanController::class, 'insert']);
// Edit Pendidikan
Route::post("{id_pegawai}/pendidikan/{id_pendidikan}", [PendidikanController::class, 'edit']);
// Delete Pendidikan
Route::get("{id_pegawai}/pendidikan/{id_pendidikan}/delete", [PendidikanController::class, 'delete']);
// Get Jenjang Pendidikan
Route::get("pendidikan/jenjang", [PendidikanController::class, "getJenjangPendidikan"]);
