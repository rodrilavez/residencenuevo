<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Incidencia;

class IncidenciasTable extends Component
{
    public $incidencias;
    public $titulo, $descripcion;
    public $editMode = false;
    public $incidenciaId;

    public function mount()
    {
        $this->incidencias = Incidencia::all();
    }

    public function store()
    {
        $this->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
        ]);

        Incidencia::create([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ]);

        $this->resetInputFields();
        $this->mount();
    }

    public function edit($id)
    {
        $incidencia = Incidencia::findOrFail($id);
        $this->incidenciaId = $id;
        $this->titulo = $incidencia->titulo;
        $this->descripcion = $incidencia->descripcion;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
        ]);

        $incidencia = Incidencia::findOrFail($this->incidenciaId);
        $incidencia->update([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ]);

        $this->resetInputFields();
        $this->editMode = false;
        $this->mount();
    }

    public function delete($id)
    {
        Incidencia::findOrFail($id)->delete();
        $this->mount();
    }

    private function resetInputFields()
    {
        $this->titulo = '';
        $this->descripcion = '';
    }

    public function render()
    {
        return view('livewire.incidencias-table');
    }
} 