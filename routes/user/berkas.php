<?php

// Data Berkas

use App\Http\Controllers\User\DataKepegawaian\BerkasController;

// Get All
Route::get("berkas", [BerkasController::class, "getAll"]);
// Insert Berkas
Route::post("berkas", [BerkasController::class, "insert"]);
// Delete Berkas
Route::get("berkas/{id_berkas}/delete", [BerkasController::class, "deleteBerkas"]);
