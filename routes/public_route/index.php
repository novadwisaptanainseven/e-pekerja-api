<?php

// GROUP BIDANG
// Get All Bidang
Route::get("bidang", [BidangController::class, "getAll"]);

// Get Bidang By Id
Route::get("bidang/{id_bidang}", [BidangController::class, "getById"]);

// Insert Bidang
Route::post("bidang", [BidangController::class, "insert"]);

// Edit Bidang
Route::put("bidang/{id_bidang}", [BidangController::class, "edit"]);

// Delete Bidang By Id
Route::delete("bidang/{id_bidang}", [BidangController::class, "delete"]);

// GROUP PEGAWAI
// Get All Pegawai (PNS, PTTH, PTTB)
Route::get("semua-pegawai", [PNSController::class, "getAllPegawai"]);
