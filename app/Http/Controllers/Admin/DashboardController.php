<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Persona;
use App\Models\RegistroBiometrico;
use App\Models\CapturaImagen;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'usuariosCount' => User::count(),
            'personasCount' => Persona::count(),
            'registrosCount' => RegistroBiometrico::count(),
            'imagenesCount' => CapturaImagen::count(),
            'registrosPorMes' => RegistroBiometrico::selectRaw('MONTH(fecha_registro) as mes, COUNT(*) as total')
                ->groupBy('mes')
                ->pluck('total', 'mes')
        ]);
    }
}
