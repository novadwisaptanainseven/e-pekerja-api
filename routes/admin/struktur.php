<?php

use App\Http\Controllers\Admin\StrukturOrgController;

// Get all struktur organisasi
Route::get("struktur", [StrukturOrgController::class, "get"]);

// Insert gambar struktur
Route::post("struktur/{id}", [StrukturOrgController::class, "insertGambar"]);

// Delete Struktur
Route::get("struktur/{id}/delete", [StrukturOrgController::class, "deleteGambar"]);
