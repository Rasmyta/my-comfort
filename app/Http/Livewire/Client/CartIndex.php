<?php

namespace App\Http\Livewire\Client;

use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;
use Livewire\Component;

class CartIndex extends Component
{
    public $cart;
    public $reservation;
    public $saved = false;

    public function render()
    {
        return view('livewire.client.cart-index');
    }

    public function makeOrder()
    {
        $this->cart = Cart::content();




        //Cleans a cart
        Cart::clear();

        //Shows the alert about successful order
        $this->saved = true;
    }

    public function add($id)
    {


        return redirect()->back()->with('message', 'Added successfully!');
    }

    public function delete($id)
    {
        $item = Cart::content()->where('id', $id)->first();
        Cart::remove($item->rowId);
    }
}
