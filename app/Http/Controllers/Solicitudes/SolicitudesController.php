<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class SolicitudesController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('solicitudes/Index', [
            'message' => 'This is my index from SolicitudesController',
        ]);
    }
}
