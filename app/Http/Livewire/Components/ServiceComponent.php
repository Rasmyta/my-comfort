<?php

namespace App\Http\Livewire\Components;

use App\Models\Service;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ServiceComponent extends Component
{
    public $service;
    public $reservation;
    public $isSelected;

    public function mount(Service $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        $this->isSelected = $this->hasCartItem($this->service->id);
        return view('livewire.components.service-component');
    }

    public function reservate()
    {
        return redirect()->back()->with('message', 'Reservado!');
    }

    public function remove($id)
    {
        $item = Cart::content()->where('id', $id)->first();
        Cart::remove($item->rowId);
        return redirect()->back()->with('message', 'Removed successfully!');
    }

    public function add($id)
    {
        // Getting the salon of the cart to dont let to reserve services from different salons
        $currentSalon = null;
        foreach (Cart::content() as $item) {
            $currentSalon = Service::find($item->id)->getSalon;
        }

        // Checking if the salons coincide
        $service = Service::findOrFail($id);
        if (!empty($currentSalon)) {
            if ($service->getSalon->id != $currentSalon->id) {
                return redirect()->back()->with('error', 'Solo puede hacer reservas en un mismo establecimiento a la vez.');
            }
        }

        Cart::add($service->id, $service->name, 1, $service->price);

        return redirect()->back()->with('message', 'Añadido! Escoge la hora');
    }


    public function toggleCartItem($id)
    {
        if (Cart::count() && $this->hasCartItem($id)) {
            $this->remove($id);
        } else {
            $this->add($id);
        }
    }

    public function hasCartItem($id)
    {
        return Cart::content()->where('id', $id)->first() != null;
    }
}
