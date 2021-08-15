<?php

use App\Http\Controllers\Admin\KenaikanPangkatController;

// Get All Kenaikan Pangkat
Route::get("kenaikan-pangkat", [KenaikanPangkatController::class, "getAll"]);

// Insert Kenaikan Pangkat
Route::post("kenaikan-pangkat/{id}", [KenaikanPangkatController::class, "create"]);

// Update Kenaikan Pangkat
Route::post("kenaikan-pangkat-update/{id}", [KenaikanPangkatController::class, "updatePangkat"]);

// Get Kenaikan Pangkat By ID
Route::get("kenaikan-pangkat/{id}", [KenaikanPangkatController::class, "getById"]);

// Batalkan Kenaikan Pangkat
Route::delete("kenaikan-pangkat-batal/{id}", [KenaikanPangkatController::class, "batalkanKenaikanPangkat"]);

// Kirim email
Route::post('kp-send-email', [KenaikanPangkatController::class, "sendEmail"]);

// Validasi berkas
Route::put("kenaikan-pangkat/{id}/validasi", [KenaikanPangkatController::class, "validasiKP"]);
