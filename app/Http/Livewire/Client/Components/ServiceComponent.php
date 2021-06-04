<?php

namespace App\Http\Livewire\Client\Components;

use App\Models\Service;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Log;

class ServiceComponent extends Component
{
    public $service;
    public $reservation;
    public $isSelected;

    protected $listeners = ['removeCartItem' => 'remove'];

    public function mount(Service $service)
    {
        $this->service = $service;
    }

    public function render()
    {
        $this->isSelected = $this->hasCartItem($this->service->id);
        Log::info('Rendering service: ', ['isSelected' => $this->isSelected]);
        return view('livewire.client.components.service-component');
    }

    public function reservate()
    {
        return redirect()->back()->with('message', 'Reservado!');
    }

    public function remove($id)
    {
        Log::info('removing... ', ['id' => $id]);

        $item = Cart::content()->where('id', $id)->first();
        if (isset($item)) {
            Cart::remove($item->rowId);
            $this->emitUp('refresh', $id);
        }
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
                return redirect()->back()->with('warning', 'Solo puede hacer reservas en un mismo establecimiento a la vez.');
            }
        }

        Cart::add($service->id, $service->name, 1, $service->price);
    }


    public function toggleCartItem($id)
    {
        Log::info('toggleCartItem: ', ['id' => $id]);

        if (Cart::count() && $this->hasCartItem($id)) {
            $this->remove($id);
            Log::info('removed: ', ['id' => $id]);
        } else {
            $this->add($id);
            Log::info('added: ', ['id' => $id]);
        }

        $this->emitUp('refresh', $id);
    }


    public function hasCartItem($id)
    {
        return Cart::content()->where('id', $id)->first() != null;
    }
}
