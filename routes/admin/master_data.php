<?php

use App\Http\Controllers\Admin\MasterData\AgamaController;
use App\Http\Controllers\Admin\MasterData\BidangController;
use App\Http\Controllers\Admin\MasterData\JabatanController;
use App\Http\Controllers\Admin\MasterData\PangkatEselonController;
use App\Http\Controllers\Admin\MasterData\PangkatGolonganController;
use App\Http\Controllers\Admin\MasterData\StatusPegawaiController;
use App\Http\Controllers\Admin\MasterData\SubBidangController;

$prefix = 'master-data/';

Route::prefix($prefix)->group(function () {
  // GROUP AGAMA
  // Get All Agama
  Route::get("agama", [AgamaController::class, "getAll"]);
  // Get Agama By Id
  Route::get("agama/{id_agama}", [AgamaController::class, "getById"]);
  // Insert Agama
  Route::post("agama", [AgamaController::class, "insert"]);
  // Edit Agama
  Route::post("agama/{id_agama}", [AgamaController::class, "edit"]);
  // Delete Agama By Id
  Route::get("agama/{id_agama}/delete", [AgamaController::class, "delete"]);

  // GROUP PANGKAT GOLONGAN
  // Get All Pangkat Golongan
  Route::get("pangkat-golongan", [PangkatGolonganController::class, "getAll"]);
  // Get Pangkat Golongan By Id
  Route::get("pangkat-golongan/{id_pangkat_golongan}", [PangkatGolonganController::class, "getById"]);
  // Insert Pangkat Golongan
  Route::post("pangkat-golongan", [PangkatGolonganController::class, "insert"]);
  // Edit Pangkat Golongan
  Route::post("pangkat-golongan/{id_pangkat_golongan}", [PangkatGolonganController::class, "edit"]);
  // Delete Pangkat Golongan By Id
  Route::get("pangkat-golongan/{id_pangkat_golongan}/delete", [PangkatGolonganController::class, "delete"]);

  // GROUP PANGKAT ESELON
  // Get All Pangkat Eselon
  Route::get("pangkat-eselon", [PangkatEselonController::class, "getAll"]);
  // Get Pangkat Eselon By Id
  Route::get("pangkat-eselon/{id_pangkat_eselon}", [PangkatEselonController::class, "getById"]);
  // Insert Pangkat Eselon
  Route::post("pangkat-eselon", [PangkatEselonController::class, "insert"]);
  // Edit Pangkat Eselon
  Route::post("pangkat-eselon/{id_pangkat_eselon}", [PangkatEselonController::class, "edit"]);
  // Delete Pangkat Eselon By Id
  Route::get("pangkat-eselon/{id_pangkat_eselon}/delete", [PangkatEselonController::class, "delete"]);

  // GROUP JABATAN
  // Get All Jabatan
  Route::get("jabatan", [JabatanController::class, "getAll"]);
  // Get Jabatan By Id
  Route::get("jabatan/{id_jabatan}", [JabatanController::class, "getById"]);
  // Insert Jabatan
  Route::post("jabatan", [JabatanController::class, "insert"]);
  // Edit Jabatan
  Route::post("jabatan/{id_jabatan}", [JabatanController::class, "edit"]);
  // Delete Jabatan By Id
  Route::get("jabatan/{id_jabatan}/delete", [JabatanController::class, "delete"]);

  // GROUP BIDANG
  // Get All Bidang
  Route::get("bidang", [BidangController::class, "getAll"]);
  // Get Bidang By Id
  Route::get("bidang/{id_bidang}", [BidangController::class, "getById"]);
  // Insert Bidang
  Route::post("bidang", [BidangController::class, "insert"]);
  // Edit Bidang
  Route::post("bidang/{id_bidang}", [BidangController::class, "edit"]);
  // Delete Bidang By Id
  Route::get("bidang/{id_bidang}/delete", [BidangController::class, "delete"]);

  // GROUP SUB BIDANG
  // Get All Sub Bidang
  Route::get("sub-bidang", [SubBidangController::class, "getAll"]);
  // Get Sub Bidang By Id
  Route::get("sub-bidang/{id_sub_bidang}", [SubBidangController::class, "getById"]);
  // Insert Sub Bidang
  Route::post("sub-bidang", [SubBidangController::class, "insert"]);
  // Edit Sub Bidang
  Route::post("sub-bidang/{id_sub_bidang}", [SubBidangController::class, "edit"]);
  // Delete Sub Bidang By Id
  Route::get("sub-bidang/{id_sub_bidang}/delete", [SubBidangController::class, "delete"]);

  // GROUP STATUS PEGAWAI
  // Get All Status Pegawai
  Route::get("status-pegawai", [StatusPegawaiController::class, "getAll"]);
  // Get Status Pegawai By Id
  Route::get("status-pegawai/{id_status_pegawai}", [StatusPegawaiController::class, "getById"]);
  // Insert Status Pegawai
  Route::post("status-pegawai", [StatusPegawaiController::class, "insert"]);
  // Edit Status Pegawai
  Route::post("status-pegawai/{id_status_pegawai}", [StatusPegawaiController::class, "edit"]);
  // Delete Status Pegawai By Id
  Route::get("status-pegawai/{id_status_pegawai}/delete", [StatusPegawaiController::class, "delete"]);
});
