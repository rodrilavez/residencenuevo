<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Horario;

class HorariosTable extends Component
{
    public $horarios;
    public $guardia_id, $inicio, $fin;
    public $editMode = false;
    public $horarioId;

    public function mount()
    {
        $this->horarios = Horario::all();
    }

    public function store()
    {
        $this->validate([
            'guardia_id' => 'required',
            'inicio' => 'required|date',
            'fin' => 'required|date|after:inicio',
        ]);

        Horario::create([
            'guardia_id' => $this->guardia_id,
            'inicio' => $this->inicio,
            'fin' => $this->fin,
        ]);

        $this->resetInputFields();
        $this->mount();
    }

    public function edit($id)
    {
        $horario = Horario::findOrFail($id);
        $this->horarioId = $id;
        $this->guardia_id = $horario->guardia_id;
        $this->inicio = $horario->inicio;
        $this->fin = $horario->fin;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate([
            'guardia_id' => 'required',
            'inicio' => 'required|date',
            'fin' => 'required|date|after:inicio',
        ]);

        $horario = Horario::findOrFail($this->horarioId);
        $horario->update([
            'guardia_id' => $this->guardia_id,
            'inicio' => $this->inicio,
            'fin' => $this->fin,
        ]);

        $this->resetInputFields();
        $this->editMode = false;
        $this->mount();
    }

    public function delete($id)
    {
        Horario::findOrFail($id)->delete();
        $this->mount();
    }

    private function resetInputFields()
    {
        $this->guardia_id = '';
        $this->inicio = '';
        $this->fin = '';
    }

    public function render()
    {
        return view('livewire.horarios-table');
    }
} 