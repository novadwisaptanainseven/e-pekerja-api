<?php

// GROUP PembaruanSK PEGAWAI
// Edit PembaruanSK

use App\Http\Controllers\Admin\PembaruanSKController;

$prefix = "pegawai/";

Route::prefix($prefix)->group(function () {

  // Get All Pembaruan SK
  Route::get("{id_pegawai}/pembaruan-sk", [PembaruanSKController::class, 'getAll']);
  // Insert Pembaruan SK
  Route::post("{id_pegawai}/pembaruan-sk", [PembaruanSKController::class, 'insert']);
  // Edit Pembaruan SK By ID
  Route::post("{id_pegawai}/pembaruan-sk/{id}", [PembaruanSKController::class, 'edit']);
  // Get Pembaruan SK By Id
  Route::get("{id_pegawai}/pembaruan-sk/{id}", [PembaruanSKController::class, 'getById']);
  // Delete Pembaruan SK By Id
  Route::delete("{id_pegawai}/pembaruan-sk/{id}", [PembaruanSKController::class, 'deleteRiwayatSK']);
});
