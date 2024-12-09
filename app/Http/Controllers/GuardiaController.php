<?php

namespace App\Http\Controllers;

use App\Models\Guardia;
use App\Models\User;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardiaController extends Controller
{
    public function index()
    {
        if(Auth::user()->role !== 'admin') abort(403);
        $guardias = Guardia::with(['user','zona'])->get();
        return view('dashboard.guardias.index', compact('guardias'));
    }

    public function create()
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $usuariosGuard = User::where('role','guard')->get();
        $zonas = Zona::all();
        return view('dashboard.guardias.create', compact('usuariosGuard','zonas'));
    }

    public function store(Request $request)
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'user_id'=>'required|exists:users,id',
            'zona_id'=>'required|exists:zonas,id'
        ]);

        Guardia::create($request->all());
        return redirect()->route('guardias.index')->with('message','Guardia creado con éxito');
    }

    public function show(Guardia $guardia)
    {
        if(Auth::user()->role !== 'admin') abort(403);
        return view('dashboard.guardias.show', compact('guardia'));
    }

    public function edit(Guardia $guardia)
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $usuariosGuard = User::where('role','guard')->get();
        $zonas = Zona::all();
        return view('dashboard.guardias.edit', compact('guardia','usuariosGuard','zonas'));
    }

    public function update(Request $request, Guardia $guardia)
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'user_id'=>'required|exists:users,id',
            'zona_id'=>'required|exists:zonas,id'
        ]);

        $guardia->update($request->all());
        return redirect()->route('guardias.index')->with('message','Guardia actualizado');
    }

    public function destroy(Guardia $guardia)
    {
        if(Auth::user()->role !== 'admin') abort(403);
        $guardia->delete();
        return redirect()->route('guardias.index')->with('message','Guardia eliminado');
    }
}
