<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalZonas = Zona::count();
        $totalResidentes = User::where('role','residente')->count();
        $totalGuardias = User::where('role','guard')->count();

        return view('dashboard.index', compact('totalZonas','totalResidentes','totalGuardias'));
    }
}
