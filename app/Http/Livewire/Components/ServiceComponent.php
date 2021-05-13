<?php

namespace App\Http\Livewire\Components;

use App\Models\Service;
use Livewire\Component;

class ServiceComponent extends Component
{
    public $service;
    public $cart;

    public function mount(Service $service)
    {
       $this->service = $service;
    }

    public function render()
    {
        return view('livewire.components.service-component');
    }

}
