<?php

namespace App\Http\Livewire\Intranet\Salons;

use App\Models\Salon;
use Livewire\Component;
use Livewire\WithPagination;

class SalonIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $salons = Salon::paginate(6);
        return view('livewire.intranet.salons.salon-index', ['salons' => $salons])->layout('layouts.intranet');
    }
}
