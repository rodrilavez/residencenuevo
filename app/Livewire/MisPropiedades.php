<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Propiedad;
use Illuminate\Support\Facades\Auth;

class MisPropiedades extends Component
{
    public $propiedades;

    public function mount()
    {
        $this->propiedades = Propiedad::whereHas('residente', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();
    }

    public function render()
    {
        return view('livewire.mis-propiedades');
    }
} 