<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notificacion; // Assuming you have a Notificacion model
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class NotificacionesGuardia extends Component
{
    public $notificaciones;

    public function mount()
    {
        $this->notificaciones = Notificacion::where('user_id', Auth::id())->get();
    }

    public function render()
    {
        return view('livewire.notificaciones-guardia');
    }
} 