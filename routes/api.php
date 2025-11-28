<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthenticateController::class, 'login']);

Route::middleware('auth:admin')->group(function () {
    Route::delete('/logout', [AuthenticateController::class, 'logout']);

    Route::post("/siswa/import", [SiswaController::class, "import"]);
    Route::post("/siswa", [SiswaController::class, "store"]);
    Route::post("/siswa/{siswaId}", [SiswaController::class, "update"]);
    Route::delete("/siswa/{siswaId}", [SiswaController::class, "destroy"]);
    Route::get("/siswa/{siswaId}", [SiswaController::class, "show"]);
    Route::get("/siswa", [SiswaController::class, "index"]);

    Route::get("/admin", [AdminController::class, "index"]);
    Route::post("/admin", [AdminController::class, "store"]);
    Route::post("/admin/{adminId}", [AdminController::class, "update"]);
    Route::delete("/admin/{adminId}", [AdminController::class, "destroy"]);
    Route::get("/admin/{adminId}", [AdminController::class, "show"]);
});
