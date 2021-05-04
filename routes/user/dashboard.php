<?php

// GROUP DASHBOARD

use App\Http\Controllers\User\DashboardController;

Route::get("dashboard", [DashboardController::class, "getInformation"]);
