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
Route::post("pensiun/{id_pensiun}", [PensiunController::class, "edit"]);
// Delete Pensiun
Route::get("pensiun/{id_pensiun}/delete", [PensiunController::class, "delete"]);
// Batalkan Pensiun
Route::get("pensiun-batal/{id_pensiun}", [PensiunController::class, "batalkanPensiun"]);
