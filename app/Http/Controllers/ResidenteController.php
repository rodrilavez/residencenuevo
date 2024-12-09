<?php

namespace App\Http\Controllers;

use App\Models\Residente;
use App\Models\User;
use App\Models\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResidenteController extends Controller
{
    public function index()
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $residentes = Residente::with(['user','propiedad'])->get();
        return view('dashboard.residentes.index', compact('residentes'));
    }

    public function create()
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $usuariosResidente = User::where('role','residente')->get();
        $propiedades = Propiedad::all();
        return view('dashboard.residentes.create', compact('usuariosResidente','propiedades'));
    }

    public function store(Request $request)
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'user_id'=>'required|exists:users,id',
            'propiedad_id'=>'nullable|exists:propiedades,id',
            'telefono'=>'nullable'
        ]);

        Residente::create($request->all());
        return redirect()->route('residentes.index')->with('message','Residente creado con éxito');
    }

    public function show(Residente $residente)
    {
        if(Auth::user()->role !== 'admin' && Auth::id() !== $residente->user_id) abort(403);
        return view('dashboard.residentes.show', compact('residente'));
    }

    public function edit(Residente $residente)
    {
        if(Auth::user()->role !== 'admin' && Auth::id() !== $residente->user_id) abort(403);

        $propiedades = Propiedad::all();
        return view('dashboard.residentes.edit', compact('residente','propiedades'));
    }

    public function update(Request $request, Residente $residente)
    {
        if(Auth::user()->role !== 'admin' && Auth::id() !== $residente->user_id) abort(403);

        $request->validate([
            'propiedad_id'=>'nullable|exists:propiedades,id',
            'telefono'=>'nullable'
        ]);

        $residente->update($request->all());
        return redirect()->route('residentes.index')->with('message','Residente actualizado');
    }

    public function destroy(Residente $residente)
    {
        if(Auth::user()->role !== 'admin') abort(403);
        $residente->delete();
        return redirect()->route('residentes.index')->with('message','Residente eliminado');
    }
}
