<?php

// Get All Dashboard Information

use App\Http\Controllers\Admin\DashboardController;

// Get All Dashboard Information
Route::get("dashboard", [DashboardController::class, "getInformation"]);
