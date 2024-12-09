<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Residente;

class ResidentesTable extends Component
{
    public $residentes;
    public $user_id, $propiedad_id, $telefono;
    public $editMode = false;
    public $residenteId;

    public function mount()
    {
        $this->residentes = Residente::all();
    }

    public function store()
    {
        $this->validate([
            'user_id' => 'required',
            'propiedad_id' => 'required',
            'telefono' => 'required',
        ]);

        Residente::create([
            'user_id' => $this->user_id,
            'propiedad_id' => $this->propiedad_id,
            'telefono' => $this->telefono,
        ]);

        $this->resetInputFields();
        $this->mount();
    }

    public function edit($id)
    {
        $residente = Residente::findOrFail($id);
        $this->residenteId = $id;
        $this->user_id = $residente->user_id;
        $this->propiedad_id = $residente->propiedad_id;
        $this->telefono = $residente->telefono;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate([
            'user_id' => 'required',
            'propiedad_id' => 'required',
            'telefono' => 'required',
        ]);

        $residente = Residente::findOrFail($this->residenteId);
        $residente->update([
            'user_id' => $this->user_id,
            'propiedad_id' => $this->propiedad_id,
            'telefono' => $this->telefono,
        ]);

        $this->resetInputFields();
        $this->editMode = false;
        $this->mount();
    }

    public function delete($id)
    {
        Residente::findOrFail($id)->delete();
        $this->mount();
    }

    private function resetInputFields()
    {
        $this->user_id = '';
        $this->propiedad_id = '';
        $this->telefono = '';
    }

    public function render()
    {
        return view('livewire.residentes-table');
    }
} 