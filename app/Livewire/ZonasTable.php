<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Zona;

class ZonasTable extends Component
{
    public $zonas;
    public $nombre, $descripcion;
    public $isEdit = false;
    public $zonaId;

    public function mount()
    {
        $this->zonas = Zona::all();
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        try {
            Zona::create([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ]);
            session()->flash('success', 'Zona creada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al crear la zona.');
        }

        $this->resetInputFields();
        $this->mount();
    }

    public function edit($id)
    {
        $zona = Zona::findOrFail($id);
        $this->zonaId = $id;
        $this->nombre = $zona->nombre;
        $this->descripcion = $zona->descripcion;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        try {
            $zona = Zona::findOrFail($this->zonaId);
            $zona->update([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ]);
            session()->flash('success', 'Zona actualizada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar la zona.');
        }

        $this->resetInputFields();
        $this->isEdit = false;
        $this->mount();
    }

    public function delete($id)
    {
        try {
            Zona::findOrFail($id)->delete();
            session()->flash('success', 'Zona eliminada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar la zona.');
        }

        $this->mount();
    }

    private function resetInputFields()
    {
        $this->nombre = '';
        $this->descripcion = '';
        $this->isEdit = false;
    }

    public function render()
    {
        return view('livewire.zonas-table');
    }
}
