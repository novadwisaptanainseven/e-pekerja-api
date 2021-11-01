<?php

use App\Http\Controllers\BerkasKpController;

$prefix = "pegawai/";

Route::prefix($prefix)->group(function () {
  // Get All Berkas Kenaikan Pangkat by ID Pegawai
  Route::get("{id_pegawai}/berkas-kp", [BerkasKpController::class, "get"]);

  // Insert Berkas Kenaikan Pangkat by ID Pegawai
  Route::post("{id_pegawai}/berkas-kp", [BerkasKpController::class, "create"]);

  // Delete Berkas Kenaikan Pangkat
  Route::get("{id_pegawai}/berkas-kp/{id_berkas_kp}/delete", [BerkasKpController::class, "destroy"]);
});
