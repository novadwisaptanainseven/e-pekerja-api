<?php

// GROUP DUK PEGAWAI
// Edit DUK

use App\Http\Controllers\Admin\DUKController;

Route::post("duk-pegawai/{id_duk}", [DUKController::class, 'edit']);
// Get All DUK
Route::get("duk-pegawai", [DUKController::class, 'getAll']);
// Get All DUK For Print
Route::get("duk-pegawai-print", [DUKController::class, 'getAllForPrint']);
// Get DUK By Id
Route::get("duk-pegawai/{id_duk}", [DUKController::class, 'getById']);
