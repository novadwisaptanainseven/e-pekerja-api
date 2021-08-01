<?php

// Image

use App\Http\Controllers\FileController;

Route::get('image/{filename}', [FileController::class, "getImage"]);

// Ijazah
Route::get('ijazah/{filename}', [FileController::class, "getIjazah"]);

// Dokumentasi Diklat
Route::get('dok_diklat/{filename}', [FileController::class, "getDokDiklat"]);

// Dokumentasi Penghargaan
Route::get('dok_penghargaan/{filename}', [FileController::class, "getDokPenghargaan"]);

// Berkas Pegawai
Route::get('berkas/{filename}', [FileController::class, "getBerkas"]);

// SK Pegawai
Route::get('sk/{filename}', [FileController::class, "getSK"]);

// SK Golongan
Route::get('document/{filename}', [FileController::class, "getDocument"]);

// Riwayat Masa Kerja
Route::get('masa-kerja/{filename}', [FileController::class, "getRiwayatMK"]);
