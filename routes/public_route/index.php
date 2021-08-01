<?php

use App\Http\Controllers\Admin\Pegawai\PNSController;
use App\Http\Controllers\Admin\MasterData\BidangController;

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

// Get Pegawai By ID (PNS, PTTH, PTTB)
Route::get("pegawai/{id_pegawai}", [PNSController::class, "getById"]);
