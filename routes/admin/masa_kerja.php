<?php

// GROUP MASA KERJA
// Edit Masa Kerja

use App\Http\Controllers\Admin\MasaKerjaController;

Route::put("masa-kerja/{id_masa_kerja}", [MasaKerjaController::class, 'edit']);
// Get All Masa Kerja
Route::get("masa-kerja", [MasaKerjaController::class, 'getAll']);
// Get All Masa Kerja For Print
Route::get("masa-kerja-pegawai-print", [MasaKerjaController::class, 'getAllForPrint']);
// Get Masa Kerja By Id
Route::get("masa-kerja/{id_masa_kerja}", [MasaKerjaController::class, 'getById']);
