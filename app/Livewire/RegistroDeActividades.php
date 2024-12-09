<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Actividad; // Assuming you have an Actividad model

class RegistroDeActividades extends Component
{
    public $actividades;
    public $actividad, $descripcion;
    public $isEdit = false;
    public $actividadId;

    public function mount()
    {
        $this->actividades = Actividad::all();
    }

    public function store()
    {
        $this->validate([
            'actividad' => 'required',
            'descripcion' => 'required',
        ]);

        Actividad::create([
            'actividad' => $this->actividad,
            'descripcion' => $this->descripcion,
        ]);

        $this->resetForm();
        $this->mount();
    }

    public function edit($id)
    {
        $actividad = Actividad::findOrFail($id);
        $this->actividadId = $id;
        $this->actividad = $actividad->actividad;
        $this->descripcion = $actividad->descripcion;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'actividad' => 'required',
            'descripcion' => 'required',
        ]);

        $actividad = Actividad::findOrFail($this->actividadId);
        $actividad->update([
            'actividad' => $this->actividad,
            'descripcion' => $this->descripcion,
        ]);

        $this->resetForm();
        $this->isEdit = false;
        $this->mount();
    }

    public function delete($id)
    {
        Actividad::findOrFail($id)->delete();
        $this->mount();
    }

    private function resetForm()
    {
        $this->actividad = '';
        $this->descripcion = '';
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.registro-de-actividades');
    }
} 