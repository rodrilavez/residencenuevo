<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidenciaController extends Controller
{
    public function index()
    {
        // Admin ve todas las incidencias.
        if(Auth::user()->role !== 'admin') abort(403);
        $incidencias = Incidencia::with('user')->get();
        return view('dashboard.incidencias.index', compact('incidencias'));
    }

    public function create()
    {
        if(Auth::user()->role !== 'admin') abort(403);
        return view('dashboard.incidencias.create');
    }

    public function store(Request $request)
    {
        // Admin crea incidencias manualmente (opcional),
        // en general las incidencias las reporta el residente vía otro medio (Livewire o API).
        if(Auth::user()->role !== 'admin') abort(403);

        $request->validate(['titulo'=>'required','descripcion'=>'required']);
        Incidencia::create([
            'user_id'=>Auth::id(),
            'titulo'=>$request->titulo,
            'descripcion'=>$request->descripcion
        ]);

        return redirect()->route('incidencias.index')->with('message','Incidencia creada');
    }

    public function show(Incidencia $incidencia)
    {
        // Admin o el usuario que la creó la pueden ver.
        if(Auth::user()->role !== 'admin' && $incidencia->user_id !== Auth::id()) abort(403);
        return view('dashboard.incidencias.show', compact('incidencia'));
    }

    public function edit(Incidencia $incidencia)
    {
        // Solo admin puede editar incidencias para, por ejemplo, cambiar estado.
        if(Auth::user()->role !== 'admin') abort(403);
        return view('dashboard.incidencias.edit', compact('incidencia'));
    }

    public function update(Request $request, Incidencia $incidencia)
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $request->validate(['titulo'=>'required','descripcion'=>'required']);
        $incidencia->update($request->all());
        return redirect()->route('incidencias.index')->with('message','Incidencia actualizada');
    }

    public function destroy(Incidencia $incidencia)
    {
        if(Auth::user()->role !== 'admin') abort(403);
        $incidencia->delete();
        return redirect()->route('incidencias.index')->with('message','Incidencia eliminada');
    }
}
