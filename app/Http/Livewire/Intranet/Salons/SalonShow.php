<?php

namespace App\Http\Livewire\Intranet\Salons;

use App\Models\Salon;
use Livewire\Component;

class SalonShow extends Component
{
    public $title;
    public $salon;

    public function mount(Salon $salon){
        $this->title = $salon->name;
        $this->salon = $salon;
    }


    public function render()
    {
        return view('livewire.intranet.salons.salon-show')->layout('layouts.intranet');
    }
}
