<?php

namespace App\Http\Livewire\Client;

use App\Models\Service;
use Livewire\Component;

class CartIndex extends Component
{
    public $cart;
    public $reservation;
    public $saved = false;
    public $addItem = false;

    protected $listeners = ['add'];

    public function render()
    {
        return view('livewire.client.cart-index');
    }


}
