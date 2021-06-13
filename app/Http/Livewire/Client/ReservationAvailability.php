<?php

namespace App\Http\Livewire\Client;

use App\Http\Controllers\CartController;
use App\Models\Salon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Log;

class ReservationAvailability extends Component
{
    public $salon;
    public $timeOutput; // asigns value from date-picker component
    public $dateOutput; // asigns value from date-picker component


    public function mount(Salon $salon)
    {
        $this->salon = $salon;
    }

    public function render()
    {
        return view('livewire.client.reservation-availability')->layout('layouts.guest');;
    }

    public function removeCartItem($id)
    {
        $item = Cart::content()->where('id', $id)->first();
        if (isset($item)) {
            Cart::remove($item->rowId);
            $this->emitSelf('$refresh');
        }
    }

    public function reserve()
    {
        CartController::reserve($this->dateOutput, $this->timeOutput);
    }

}
