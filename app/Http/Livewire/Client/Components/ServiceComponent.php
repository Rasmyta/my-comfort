<?php

namespace App\Http\Livewire\Client\Components;

use App\Http\Controllers\CartController;
use App\Models\Service;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Log;
use App\Http\Controllers\MainController;

class ServiceComponent extends Component
{
    public $service;
    public $reservation;
    public $isSelected;

    protected function getListeners()
    {
        return ['removeCartItem' => 'remove'];
    }

    public function mount(Service $service)
    {
        $this->service = $service;
    }

    public function reserve()
    {
        MainController::reserve();
    }

    public function render()
    {
        $this->isSelected = $this->hasCartItem($this->service->id);
        Log::info('Rendering service: ', ['isSelected' => $this->isSelected]);
        return view('livewire.client.components.service-component');
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

    public function toggleCartItem($id)
    {
        Log::info('toggleCartItem: ', ['id' => $id]);

        if (Cart::count() && $this->hasCartItem($id)) {
            CartController::remove($id);
            Log::info('removed: ', ['id' => $id]);
        } else {
            CartController::add($id);
            Log::info('added: ', ['id' => $id]);
        }

        $this->emitUp('refresh', $id);
    }


    public function hasCartItem($id)
    {
        return Cart::content()->where('id', $id)->first() != null;
    }
}
