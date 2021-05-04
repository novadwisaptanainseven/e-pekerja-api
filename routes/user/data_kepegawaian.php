<?php

use App\Http\Controllers\User\DataKepegawaian\BerkasController;
use App\Http\Controllers\User\DataKepegawaian\DataDiriController;
use App\Http\Controllers\User\DataKepegawaian\DiklatController;
use App\Http\Controllers\User\DataKepegawaian\KeluargaController;
use App\Http\Controllers\User\DataKepegawaian\PendidikanController;
use App\Http\Controllers\User\DataKepegawaian\PenghargaanController;
use App\Http\Controllers\User\DataKepegawaian\RiwayatKerjaController;

$prefix = 'data-kepegawaian/';

Route::prefix($prefix)->group(function () {
  // Data Diri
  Route::get("data-diri", [DataDiriController::class, "getDataDiri"]);
  // Data Keluarga
  Route::get("keluarga", [KeluargaController::class, "getAll"]);
  // Data Pendidikan
  Route::get("pendidikan", [PendidikanController::class, "getAll"]);
  // Data Diklat
  Route::get("diklat", [DiklatController::class, "getAll"]);
  // Data Riwayat Kerja
  Route::get("riwayat-kerja", [RiwayatKerjaController::class, "getAll"]);
  // Data Penghargaan
  Route::get("penghargaan", [PenghargaanController::class, "getAll"]);
  // Get Penghargaan By ID
  Route::get("penghargaan/{id_penghargaan}", [PenghargaanController::class, "getById"]);

  // Data Berkas
  // Get All
  Route::get("berkas", [BerkasController::class, "getAll"]);
  // Insert Berkas
  Route::post("berkas", [BerkasController::class, "insert"]);
  // Delete Berkas
  Route::delete("berkas/{id_berkas}", [BerkasController::class, "deleteBerkas"]);
});
