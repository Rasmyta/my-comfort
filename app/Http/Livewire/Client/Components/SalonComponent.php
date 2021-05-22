<?php

namespace App\Http\Livewire\Client\Components;

use App\Models\Salon;
use Livewire\Component;

class SalonComponent extends Component
{

    public Salon $salon;

    public function mount($salonId)
    {
        $this->salon = Salon::findOrFail($salonId);
    }


    public function render()
    {
        return view('livewire.client.components.salon-component');
    }
}
