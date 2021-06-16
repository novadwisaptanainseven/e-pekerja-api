<?php

// Export PTTH to Excel

use App\Http\Controllers\Admin\Pegawai\PTTHController;

Route::get('ptth/export', [PTTHController::class, "exportToExcel"]);
