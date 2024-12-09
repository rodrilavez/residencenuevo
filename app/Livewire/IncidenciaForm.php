<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Incidencia;
use Illuminate\Support\Facades\Auth;

class IncidenciaForm extends Component
{
    public $titulo, $descripcion;

    public function store()
    {
        $this->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
        ]);

        Incidencia::create([
            'user_id' => Auth::id(),
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ]);

        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->titulo = '';
        $this->descripcion = '';
    }

    public function render()
    {
        return view('livewire.incidencia-form');
    }
} 