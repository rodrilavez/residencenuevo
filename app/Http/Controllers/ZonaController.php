<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZonaController extends Controller
{
    public function index()
    {
        // Todos los roles pueden ver la lista, o si prefieres solo admin, descomenta la siguiente línea:
        // if(Auth::user()->role !== 'admin') abort(403);

        $zonas = Zona::all();
        return view('dashboard.zonas.index', compact('zonas'));
    }

    public function create()
    {
        if(Auth::check() && Auth::user()->role !== 'admin') abort(403);
        return view('dashboard.zonas.create');
    }

    public function store(Request $request)
    {
        if(Auth::check() && Auth::user()->role !== 'admin') abort(403);

        $request->validate(['nombre'=>'required']);
        Zona::create($request->all());
        return redirect()->route('zonas.index')->with('message','Zona creada con éxito');
    }

    public function show(Zona $zona)
    {
        // Si quieres, el admin o quizás otros roles podrían verlo
        return view('dashboard.zonas.show', compact('zona'));
    }

    public function edit(Zona $zona)
    {
        if(Auth::check() && Auth::user()->role !== 'admin') abort(403);
        return view('dashboard.zonas.edit', compact('zona'));
    }

    public function update(Request $request, Zona $zona)
    {
        if(Auth::check() && Auth::user()->role !== 'admin') abort(403);

        $request->validate(['nombre'=>'required']);
        $zona->update($request->all());
        return redirect()->route('zonas.index')->with('message','Zona actualizada');
    }

    public function destroy(Zona $zona)
    {
        if(Auth::check() && Auth::user()->role !== 'admin') abort(403);
        $zona->delete();
        return redirect()->route('zonas.index')->with('message','Zona eliminada');
    }
}
