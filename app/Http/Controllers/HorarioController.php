<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Guardia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HorarioController extends Controller
{
    public function index()
    {
        // Admin ve todos, el guardia ve solo los suyos
        if(Auth::user()->role === 'admin') {
            $horarios = Horario::with('guardia.user')->get();
        } elseif (Auth::user()->role === 'guard') {
            $guardia = Guardia::where('user_id', Auth::id())->first();
            $horarios = $guardia ? $guardia->horarios : collect();
        } else {
            abort(403);
        }

        return view('dashboard.horarios.index', compact('horarios'));
    }

    public function create()
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $guardias = Guardia::with('user')->get();
        return view('dashboard.horarios.create', compact('guardias'));
    }

    public function store(Request $request)
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'guardia_id'=>'required|exists:guardias,id',
            'inicio'=>'required|date',
            'fin'=>'required|date|after:inicio'
        ]);

        Horario::create($request->all());
        return redirect()->route('horarios.index')->with('message','Horario creado con éxito');
    }

    public function show(Horario $horario)
    {
        // Admin o el guardia dueño del horario
        $this->authorizeHorario($horario);
        return view('dashboard.horarios.show', compact('horario'));
    }

    public function edit(Horario $horario)
    {
        if(Auth::user()->role !== 'admin') abort(403);
        $guardias = Guardia::with('user')->get();
        return view('dashboard.horarios.edit', compact('horario','guardias'));
    }

    public function update(Request $request, Horario $horario)
    {
        if(Auth::user()->role !== 'admin') abort(403);

        $request->validate([
            'guardia_id'=>'required|exists:guardias,id',
            'inicio'=>'required|date',
            'fin'=>'required|date|after:inicio'
        ]);

        $horario->update($request->all());
        return redirect()->route('horarios.index')->with('message','Horario actualizado');
    }

    public function destroy(Horario $horario)
    {
        if(Auth::user()->role !== 'admin') abort(403);
        $horario->delete();
        return redirect()->route('horarios.index')->with('message','Horario eliminado');
    }

    protected function authorizeHorario(Horario $horario)
    {
        if(Auth::user()->role === 'admin') return true;
        if(Auth::user()->role === 'guard' && $horario->guardia->user_id === Auth::id()) return true;
        abort(403);
    }
}
