<?php

// Get All Riwayat SK

use App\Http\Controllers\Admin\PembaruanSKController;

Route::get("{id_pegawai}/riwayat-sk", [PembaruanSKController::class, 'getAll']);
