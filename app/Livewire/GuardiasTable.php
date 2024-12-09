<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Guardia;

class GuardiasTable extends Component
{
    public $guardias;
    public $user_id, $zona_id;
    public $editMode = false;
    public $guardiaId;

    public function mount()
    {
        $this->guardias = Guardia::all();
    }

    public function store()
    {
        $this->validate([
            'user_id' => 'required',
            'zona_id' => 'required',
        ]);

        Guardia::create([
            'user_id' => $this->user_id,
            'zona_id' => $this->zona_id,
        ]);

        $this->resetInputFields();
        $this->mount();
    }

    public function edit($id)
    {
        $guardia = Guardia::findOrFail($id);
        $this->guardiaId = $id;
        $this->user_id = $guardia->user_id;
        $this->zona_id = $guardia->zona_id;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate([
            'user_id' => 'required',
            'zona_id' => 'required',
        ]);

        $guardia = Guardia::findOrFail($this->guardiaId);
        $guardia->update([
            'user_id' => $this->user_id,
            'zona_id' => $this->zona_id,
        ]);

        $this->resetInputFields();
        $this->editMode = false;
        $this->mount();
    }

    public function delete($id)
    {
        Guardia::findOrFail($id)->delete();
        $this->mount();
    }

    private function resetInputFields()
    {
        $this->user_id = '';
        $this->zona_id = '';
    }

    public function render()
    {
        return view('livewire.guardias-table');
    }
} 