<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Horario;
use Illuminate\Support\Facades\Auth;

class MisHorarios extends Component
{
    public $horarios;

    public function mount()
    {
        $this->horarios = Horario::whereHas('guardia', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();
    }

    public function render()
    {
        return view('livewire.mis-horarios');
    }
} 