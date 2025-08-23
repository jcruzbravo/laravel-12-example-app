<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Solicitudes\SolicitudesController;

Route::middleware('auth')->group(function () {
    Route::redirect('solicitudes', '/solicitudes/inicio');

    Route::get('solicitudes/inicio', [SolicitudesController::class, 'index'])->name('solicitudes.index');
});
