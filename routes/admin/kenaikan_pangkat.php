<?php

use App\Http\Controllers\Admin\KenaikanPangkatController;

// Get All Kenaikan Pangkat
Route::get("kenaikan-pangkat", [KenaikanPangkatController::class, "getAll"]);
// Insert Kenaikan Pangkat

Route::post("kenaikan-pangkat/{id}", [KenaikanPangkatController::class, "create"]);

// Update Kenaikan Pangkat
Route::put("kenaikan-pangkat-update/{id}", [KenaikanPangkatController::class, "updatePangkat"]);

// Batalkan Kenaikan Pangkat
Route::delete("kenaikan-pangkat-batal/{id}", [KenaikanPangkatController::class, "batalkanKenaikanPangkat"]);
