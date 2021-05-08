<?php

namespace App\Http\Livewire\Intranet\Reservations;

use Livewire\Component;

class ReservationIndex extends Component
{
    public $title = 'Reservas';

    public function render()
    {
        return view('livewire.intranet.reservations.reservation-index')->layout('layouts.intranet');
    }
}
