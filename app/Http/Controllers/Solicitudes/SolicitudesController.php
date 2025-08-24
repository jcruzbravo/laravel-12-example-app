<?php

namespace App\Http\Controllers\Solicitudes;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class SolicitudesController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('solicitudes/Index', [
            'message' => 'This is my index from SolicitudesController',
            'users' => User::all(),
        ]);
    }
}
