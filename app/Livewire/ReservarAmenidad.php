<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Propiedad;
use Illuminate\Support\Facades\Auth;

class ReservarAmenidad extends Component
{
    public $amenidades;
    public $selectedAmenidad;

    public function mount()
    {
        $this->amenidades = Propiedad::where('es_amenidad', true)->get();
    }

    public function reservar()
    {
        // Logic to reserve the amenity
        // This is a placeholder for actual reservation logic
        session()->flash('message', 'Amenidad reservada con éxito.');
    }

    public function render()
    {
        return view('livewire.reservar-amenidad');
    }
} 