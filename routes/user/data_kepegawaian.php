<?php

use App\Http\Controllers\Admin\RiwayatGolonganController;
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

  // Get all riwayat golongan by id pegawai
  Route::get("{id_pegawai}/riwayat-golongan", [RiwayatGolonganController::class, "get"]);

  // Keluarga
  Route::get("keluarga", [KeluargaController::class, "getAll"]);
  include_once __DIR__ . "/keluarga.php";

  // Pendidikan
  Route::get("pendidikan", [PendidikanController::class, "getAll"]);
  include_once __DIR__ . "/pendidikan.php";

  // Diklat
  Route::get("diklat", [DiklatController::class, "getAll"]);
  include_once __DIR__ . "/diklat.php";

  // Riwayat Kerja
  Route::get("riwayat-kerja", [RiwayatKerjaController::class, "getAll"]);
  include_once __DIR__ . "/riwayat_kerja.php";

  // Penghargaan
  Route::get("penghargaan", [PenghargaanController::class, "getAll"]);
  Route::get("penghargaan/{id_penghargaan}", [PenghargaanController::class, "getById"]);
  include_once __DIR__ . "/penghargaan.php";

  // Riwayat Golongan
  include_once __DIR__ . "/riwayat_golongan.php";

  // Riwayat SK
  include_once __DIR__ . "/riwayat_sk.php";

  // Berkas
  include_once __DIR__ . "/berkas.php";
});
