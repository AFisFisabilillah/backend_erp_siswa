<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthenticateController::class, 'login']);

Route::middleware('auth:admin')->group(function () {
    Route::delete('logout', [AuthenticateController::class, 'logout']);
    Route::post("/siswa", [SiswaController::class, "store"]);
    Route::put("/siswa/{siswa}", [SiswaController::class, "update"]);
    Route::
});
