<?php

use App\Http\Controllers\Admin\PegawaiBerhentiController;

// Get All Pembaruan SK
Route::get("pegawai-berhenti", [PegawaiBerhentiController::class, 'get']);
// Insert Pembaruan SK
Route::post("pegawai-berhenti", [PegawaiBerhentiController::class, 'create']);
// Edit Pembaruan SK By ID
Route::post("pegawai-berhenti/{id_pegawai_berhenti}", [PegawaiBerhentiController::class, 'update']);
// Get Pembaruan SK By Id
Route::get("pegawai-berhenti/{id_pegawai_berhenti}", [PegawaiBerhentiController::class, 'getById']);
// Delete Pembaruan SK By Id
Route::get("pegawai-berhenti-batal/{id_pegawai_berhenti}", [PegawaiBerhentiController::class, 'destroy']);
