<?php

use App\Http\Controllers\Admin\CutiController;
use App\Http\Controllers\Admin\KGBController;
use App\Http\Controllers\Admin\Pegawai\AbsensiController;
use App\Http\Controllers\Admin\Pegawai\BerkasController;
use App\Http\Controllers\Admin\Pegawai\DiklatController;
use App\Http\Controllers\Admin\Pegawai\KeluargaController;
use App\Http\Controllers\Admin\Pegawai\PendidikanController;
use App\Http\Controllers\Admin\Pegawai\PenghargaanController;
use App\Http\Controllers\Admin\Pegawai\PTTBController;
use App\Http\Controllers\Admin\Pegawai\PTTHController;
use App\Http\Controllers\Admin\Pegawai\RiwayatKerjaController;
use App\Http\Controllers\Admin\Pegawai\PNSController;

$prefix = 'pegawai/';

Route::prefix($prefix)->group(function () {
  // Get All Pegawai (PNS, PTTH, PTTB)
  Route::get("semua-pegawai", [PNSController::class, "getAllPegawai"]);

  // GROUP PNS
  // Get All PNS
  Route::get("pns", [PNSController::class, 'getAll']);
  // Get PNS By ID
  Route::get("pns/{id_pegawai}", [PNSController::class, 'getById']);
  // Insert PNS
  Route::post("pns", [PNSController::class, 'insert']);
  // Edit PNS
  Route::post("pns/{id_pegawai}", [PNSController::class, 'edit']);
  // Delete PNS
  Route::delete("pns/{id_pegawai}", [PNSController::class, 'delete']);

  // GROUP PTTH
  // Get All PTTH
  Route::get("ptth", [PTTHController::class, 'getAll']);
  // Get PTTH By ID
  Route::get("ptth/{id_pegawai}", [PTTHController::class, 'getById']);
  // Insert PTTH
  Route::post("ptth", [PTTHController::class, 'insert']);
  // Edit PTTH
  Route::post("ptth/{id_pegawai}", [PTTHController::class, 'edit']);
  // Delete PTTH
  Route::delete("ptth/{id_pegawai}", [PTTHController::class, 'delete']);

  // GROUP PTTB
  // Get All PTTB
  Route::get("pttb", [PTTBController::class, 'getAll']);
  // Get PTTB By ID
  Route::get("pttb/{id_pegawai}", [PTTBController::class, 'getById']);
  // Insert PTTB
  Route::post("pttb", [PTTBController::class, 'insert']);
  // Edit PTTB
  Route::post("pttb/{id_pegawai}", [PTTBController::class, 'edit']);
  // Delete PTTB
  Route::delete("pttb/{id_pegawai}", [PTTBController::class, 'delete']);

  // GROUP KELUARGA
  // Get All Keluarga
  Route::get("{id_pegawai}/keluarga", [KeluargaController::class, 'getAll']);
  // Get Keluarga By ID
  Route::get("{id_pegawai}/keluarga/{id_keluarga}", [KeluargaController::class, 'getById']);
  // Insert Keluarga
  Route::post("{id_pegawai}/keluarga", [KeluargaController::class, 'insert']);
  // Edit Keluarga
  Route::put("{id_pegawai}/keluarga/{id_keluarga}", [KeluargaController::class, 'edit']);
  // Delete Keluarga
  Route::delete("{id_pegawai}/keluarga/{id_keluarga}", [KeluargaController::class, 'delete']);

  // GROUP PENDIDIKAN
  // Get All Pendidikan
  Route::get("{id_pegawai}/pendidikan", [PendidikanController::class, 'getAll']);
  // Get Pendidikan By ID
  Route::get("{id_pegawai}/pendidikan/{id_pendidikan}", [PendidikanController::class, 'getById']);
  // Insert Pendidikan
  Route::post("{id_pegawai}/pendidikan", [PendidikanController::class, 'insert']);
  // Edit Pendidikan
  Route::post("{id_pegawai}/pendidikan/{id_pendidikan}", [PendidikanController::class, 'edit']);
  // Delete Pendidikan
  Route::delete("{id_pegawai}/pendidikan/{id_pendidikan}", [PendidikanController::class, 'delete']);

  // GROUP DIKLAT
  // Get All Diklat
  Route::get("{id_pegawai}/diklat", [DiklatController::class, 'getAll']);
  // Get Diklat By ID
  Route::get("{id_pegawai}/diklat/{id_diklat}", [DiklatController::class, 'getById']);
  // Insert Diklat
  Route::post("{id_pegawai}/diklat", [DiklatController::class, 'insert']);
  // Edit Diklat
  Route::post("{id_pegawai}/diklat/{id_diklat}", [DiklatController::class, 'edit']);
  // Delete Diklat
  Route::delete("{id_pegawai}/diklat/{id_diklat}", [DiklatController::class, 'delete']);

  // GROUP RIWAYAT KERJA
  // Get All Riwayat Kerja
  Route::get("{id_pegawai}/riwayat-kerja", [RiwayatKerjaController::class, 'getAll']);
  // Get Riwayat Kerja By ID
  Route::get("{id_pegawai}/riwayat-kerja/{id_riwayat_kerja}", [RiwayatKerjaController::class, 'getById']);
  // Insert Riwayat Kerja
  Route::post("{id_pegawai}/riwayat-kerja", [RiwayatKerjaController::class, 'insert']);
  // Edit Riwayat Kerja
  Route::put("{id_pegawai}/riwayat-kerja/{id_riwayat_kerja}", [RiwayatKerjaController::class, 'edit']);
  // Delete Riwayat Kerja
  Route::delete("{id_pegawai}/riwayat-kerja/{id_riwayat_kerja}", [RiwayatKerjaController::class, 'delete']);

  // GROUP PENGHARGAAN
  // Get All Penghargaan
  Route::get("{id_pegawai}/penghargaan", [PenghargaanController::class, 'getAll']);
  // Get Penghargaan By ID
  Route::get("{id_pegawai}/penghargaan/{id_penghargaan}", [PenghargaanController::class, 'getById']);
  // Insert Penghargaan
  Route::post("{id_pegawai}/penghargaan", [PenghargaanController::class, 'insert']);
  // Edit Penghargaan
  Route::post("{id_pegawai}/penghargaan/{id_penghargaan}", [PenghargaanController::class, 'edit']);
  // Delete Penghargaan
  Route::delete("{id_pegawai}/penghargaan/{id_penghargaan}", [PenghargaanController::class, 'delete']);

  // GROUP BERKAS
  // Get All Berkas
  Route::get("{id_pegawai}/berkas", [BerkasController::class, 'getAll']);
  // Get Berkas By ID
  Route::get("{id_pegawai}/berkas/{id_berkas}", [BerkasController::class, 'getById']);
  // Insert Berkas
  Route::post("{id_pegawai}/berkas", [BerkasController::class, 'insert']);
  // Edit Berkas
  Route::put("{id_pegawai}/berkas/{id_berkas}", [BerkasController::class, 'edit']);
  // Delete Berkas
  Route::delete("{id_pegawai}/berkas/{id_berkas}", [BerkasController::class, 'delete']);

  // GROUP KENAIKAN GAJI BERKALA
  // Insert Kenaikan Gaji Berkala
  Route::post("{id_pegawai}/kgb", [KGBController::class, 'insert']);
  // Edit Kenaikan Gaji Berkala
  Route::put("{id_pegawai}/kgb/{id_kgb}", [KGBController::class, 'edit']);
  // Get All Kenaikan Gaji Berkala
  Route::get("{id_pegawai}/kgb", [KGBController::class, 'getAll']);
  // Get Kenaikan Gaji Berkala Terbaru
  Route::get("{id_pegawai}/kgb-terbaru", [KGBController::class, 'getKGBTerbaru']);
  // Get Kenaikan Gaji Berkala By Id
  Route::get("{id_pegawai}/kgb/{id_kgb}", [KGBController::class, 'getById']);
  // Delete Kenaikan Gaji Berkala By Id
  Route::delete("{id_pegawai}/kgb/{id_kgb}", [KGBController::class, 'delete']);
  // Get KGB yg berjalan dan akan naik gaji
  Route::get("kgb", [KGBController::class, 'getKGBPegawai']);
  // Update Gaji Pegawai di Sistem
  Route::put("{id_pegawai}/update-gaji", [KGBController::class, "updateGaji"]);

  // GROUP CUTI
  // Insert Cuti
  Route::post("{id_pegawai}/cuti", [CutiController::class, 'insert']);
  // Edit Cuti
  Route::put("{id_pegawai}/cuti/{id_cuti}", [CutiController::class, 'edit']);
  // Update Status Cuti
  Route::put("{id_pegawai}/cuti/{id_cuti}/status", [CutiController::class, 'updateStatus']);
  // Get All Cuti by Id Pegawai
  Route::get("{id_pegawai}/cuti", [CutiController::class, 'getAll']);
  // Get Cuti by Id Cuti
  Route::get("{id_pegawai}/cuti/{id_cuti}", [CutiController::class, 'getById']);
  // Get All Cuti Pegawai
  Route::get("cuti", [CutiController::class, 'getAllCuti']);
  // Get Cuti By Id
  Route::delete("{id_pegawai}/cuti/{id_cuti}", [CutiController::class, 'delete']);
  // Search Cuti By Nama Pegawai
  Route::get("cuti-nama", [CutiController::class, 'getByName']);
  // Get All Pegawai Cuti
  Route::get("pegawai-cuti", [CutiController::class, 'getPegawaiCuti']);
  // Get Pegawai yang sedang cuti dan akan cuti
  Route::get("pegawai-status-cuti", [CutiController::class, 'getPegawaiStatusCuti']);


  // GROUP ABSENSI
  // Get All Absensi by Id Pegawai and Query Parameters
  Route::get("{id_pegawai}/absensi-params", [AbsensiController::class, "getAbsensiByQuery"]);
  // Get Riwayat Absensi by Id Pegawai and Filter
  Route::get("{id_pegawai}/absensi", [AbsensiController::class, "getAbsensiByFilter"]);
  // Insert Absensi
  Route::post("{id_pegawai}/absensi", [AbsensiController::class, "insert"]);
  // Insert or Update Absensi
  Route::post("{id_pegawai}/absensi/insert-update", [AbsensiController::class, "insertOrUpdate"]);
  // Edit Absensi
  Route::put("{id_pegawai}/absensi/{id_absensi}", [AbsensiController::class, "edit"]);
  // Get Absensi by Id Pegawai & Id Absensi
  Route::get("{id_pegawai}/absensi/{id_absensi}", [AbsensiController::class, "getById"]);
  // Delete Absensi
  Route::delete("{id_pegawai}/absensi/{id_absensi}", [AbsensiController::class, "delete"]);
  // Get Informasi Rekap Absensi per Tahun by Id Pegawai
  Route::get("{id_pegawai}/rekap-absensi", [AbsensiController::class, "getRekapAbsensiPerTahun"]);
  // Get All Rekap Absensi Pegawai Per Tahun 
  Route::get("rekap-absensi", [AbsensiController::class, "getAllRekapAbsensiPerTahun"]);
  // Get All Rekap Absensi Pegawai by Tanggal 
  Route::get("rekap-absensi-tanggal", [AbsensiController::class, "getRekapAbsensiByDate"]);
  // Tambah Rekap Absensi
  Route::post("{id_pegawai}/rekap-absensi", [AbsensiController::class, "insertRekapAbsensi"]);
});
