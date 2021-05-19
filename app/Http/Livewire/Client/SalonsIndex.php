<?php

namespace App\Http\Livewire\Client;

use App\Models\Category;
use App\Models\Salon;
use Livewire\Component;

class SalonsIndex extends Component
{

    public $salons;

    public function mount($category)
    {
        $categoryId = Category::where('name', '=', $category)->get()->first()->id;
        $this->salons = Salon::salonsByCategory($categoryId);
    }

    public function render()
    {
        return view('livewire.client.salons-index')->layout('layouts.app');;
    }
}
