<?php

// GROUP PENGHARGAAN
// Get All Penghargaan

use App\Http\Controllers\Admin\PenghargaanController;

Route::get("penghargaan", [PenghargaanController::class, "getAll"]);
// Insert Penghargaan
Route::post("penghargaan", [PenghargaanController::class, "insert"]);
// Detail Penghargaan
Route::get("penghargaan/{id_penghargaan}", [PenghargaanController::class, "getById"]);
// Edit Penghargaan
Route::post("penghargaan/{id_penghargaan}", [PenghargaanController::class, "edit"]);
// Delete Penghargaan
Route::get("penghargaan/{id_penghargaan}/delete", [PenghargaanController::class, "delete"]);
