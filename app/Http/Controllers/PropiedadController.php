<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropiedadController extends Controller
{
    public function index()
    {
        // Admin puede ver todas, otros roles tal vez solo leer:
        if(Auth::check() && Auth::user()->role === 'residente') {
            // Un residente quizás solo vea las propiedades/amenidades de su zona
            // Dependiendo de la lógica, aquí podrías filtrar
        }
        
        $propiedades = Propiedad::with('zona')->get();
        return view('dashboard.propiedades.index', compact('propiedades'));
    }

    public function create()
    {
        if(Auth::check() && Auth::user()->role !== 'admin') abort(403);

        $zonas = Zona::all();
        return view('dashboard.propiedades.create', compact('zonas'));
    }

    public function store(Request $request)
    {
        if(Auth::check() && Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'zona_id'=>'required|exists:zonas,id',
            'nombre'=>'required'
        ]);

        Propiedad::create($request->all());
        return redirect()->route('propiedades.index')->with('message','Propiedad creada con éxito');
    }

    public function show(Propiedad $propiedad)
    {
        return view('dashboard.propiedades.show', compact('propiedad'));
    }

    public function edit(Propiedad $propiedad)
    {
        if(Auth::check() && Auth::user()->role !== 'admin') abort(403);

        $zonas = Zona::all();
        return view('dashboard.propiedades.edit', compact('propiedad','zonas'));
    }

    public function update(Request $request, Propiedad $propiedad)
    {
        if(Auth::check() && Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'zona_id'=>'required|exists:zonas,id',
            'nombre'=>'required'
        ]);
        $propiedad->update($request->all());
        return redirect()->route('propiedades.index')->with('message','Propiedad actualizada');
    }

    public function destroy(Propiedad $propiedad)
    {
        if(Auth::check() && Auth::user()->role !== 'admin') abort(403);

        $propiedad->delete();
        return redirect()->route('propiedades.index')->with('message','Propiedad eliminada');
    }
}
