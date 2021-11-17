<?php

// GROUP PembaruanSK PEGAWAI
// Edit PembaruanSK

use App\Http\Controllers\Admin\PembaruanSKController;

$prefix = "pegawai/";

Route::prefix($prefix)->group(function () {

  // Get All SK Pegawai
  Route::get("sk", [PembaruanSKController::class, 'get']);

  // Get SK Pegawai By ID
  Route::get("sk/{id}", [PembaruanSKController::class, 'getSkById']);
  // Get All Pembaruan SK
  Route::get("{id_pegawai}/pembaruan-sk", [PembaruanSKController::class, 'getAll']);
  // Insert Pembaruan SK
  Route::post("{id_pegawai}/pembaruan-sk", [PembaruanSKController::class, 'insert']);
  // Insert SK
  Route::post("upload-sk", [PembaruanSKController::class, 'upload']);
  // Edit Pembaruan SK By ID
  Route::post("{id_pegawai}/pembaruan-sk/{id}", [PembaruanSKController::class, 'edit']);
  // Edit SK By ID
  Route::post("sk/{id}", [PembaruanSKController::class, 'editSK']);
  // Get Pembaruan SK By Id
  Route::get("{id_pegawai}/pembaruan-sk/{id}", [PembaruanSKController::class, 'getById']);
  // Delete Pembaruan SK By Id
  Route::get("{id_pegawai}/pembaruan-sk/{id}/delete", [PembaruanSKController::class, 'deleteRiwayatSK']);

  // Insert Riwayat SK
  Route::post("{id_pegawai}/riwayat-sk", [PembaruanSKController::class, 'insert']);
});
