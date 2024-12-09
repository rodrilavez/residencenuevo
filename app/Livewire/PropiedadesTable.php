<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Propiedad;

class PropiedadesTable extends Component
{
    public $propiedades;
    public $nombre, $zona_id, $descripcion, $es_amenidad;
    public $editMode = false;
    public $propiedadId;

    public function mount()
    {
        $this->propiedades = Propiedad::all();
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'zona_id' => 'required',
            'descripcion' => 'required',
            'es_amenidad' => 'required|boolean',
        ]);

        try {
            Propiedad::create([
                'nombre' => $this->nombre,
                'zona_id' => $this->zona_id,
                'descripcion' => $this->descripcion,
                'es_amenidad' => $this->es_amenidad,
            ]);
            session()->flash('success', 'Propiedad creada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al crear la propiedad.');
        }

        $this->resetInputFields();
        $this->mount();
    }

    public function edit($id)
    {
        $propiedad = Propiedad::findOrFail($id);
        $this->propiedadId = $id;
        $this->nombre = $propiedad->nombre;
        $this->zona_id = $propiedad->zona_id;
        $this->descripcion = $propiedad->descripcion;
        $this->es_amenidad = $propiedad->es_amenidad;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required',
            'zona_id' => 'required',
            'descripcion' => 'required',
            'es_amenidad' => 'required|boolean',
        ]);

        try {
            $propiedad = Propiedad::findOrFail($this->propiedadId);
            $propiedad->update([
                'nombre' => $this->nombre,
                'zona_id' => $this->zona_id,
                'descripcion' => $this->descripcion,
                'es_amenidad' => $this->es_amenidad,
            ]);
            session()->flash('success', 'Propiedad actualizada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar la propiedad.');
        }

        $this->resetInputFields();
        $this->editMode = false;
        $this->mount();
    }

    public function delete($id)
    {
        try {
            Propiedad::findOrFail($id)->delete();
            session()->flash('success', 'Propiedad eliminada exitosamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar la propiedad.');
        }

        $this->mount();
    }

    private function resetInputFields()
    {
        $this->nombre = '';
        $this->zona_id = '';
        $this->descripcion = '';
        $this->es_amenidad = '';
    }

    public function render()
    {
        return view('livewire.propiedades-table');
    }
}