<?php

use App\Http\Controllers\Admin\Pegawai\MutasiController;

// GROUP MUTASI
// Get All Mutasi
Route::get("mutasi", [MutasiController::class, "getAll"]);
// Insert Mutasi

Route::post("mutasi", [MutasiController::class, "insert"]);
// Detail Mutasi

Route::get("mutasi/{id_mutasi}", [MutasiController::class, "getById"]);

// Edit Mutasi
Route::post("mutasi/{id_mutasi}", [MutasiController::class, "edit"]);

// Delete Mutasi
Route::get("mutasi/{id_mutasi}/delete", [MutasiController::class, "delete"]);

// Batalkan Mutasi
Route::get("mutasi-batal/{id_mutasi}/delete", [MutasiController::class, "batalkanMutasi"]);
