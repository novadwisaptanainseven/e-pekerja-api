<?php

use App\Http\Controllers\Admin\PensiunController;

// GROUP PENSIUN
// Get All Pensiun

Route::get("pensiun", [PensiunController::class, "getAll"]);
// Insert Pensiun
Route::post("pensiun", [PensiunController::class, "insert"]);
// Detail Pensiun
Route::get("pensiun/{id_pensiun}", [PensiunController::class, "getById"]);
// Edit Pensiun
Route::put("pensiun/{id_pensiun}", [PensiunController::class, "edit"]);
// Delete Pensiun
Route::delete("pensiun/{id_pensiun}", [PensiunController::class, "delete"]);
// Batalkan Pensiun
Route::delete("pensiun-batal/{id_pensiun}", [PensiunController::class, "batalkanPensiun"]);
