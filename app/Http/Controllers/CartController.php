<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Log;

class CartController extends Controller
{

    public static function reserve($dateOutput, $timeOutput)
    {
        $cart = Cart::content();
        $salonId = '';

        foreach ($cart as $item) {
            $salonId = Service::findOrFail($item->id)->getSalon->id;
        }

        $reservation = new Reservation();
        // if authorized, else redirect to login/register then redirect to reservation-availability

        $reservation->salon_id = $salonId;
        $reservation->user_id = auth()->id();
        $reservation->date = $dateOutput;
        $reservation->time = $timeOutput;
        $reservation->save();

        foreach ($cart as $item) {
            $reservation->getServices()->attach(
                $item->id
            );
        }

        //Cleans a cart
        Cart::destroy();

        return redirect()->back()->with('message', 'Reservado!');
    }

    public static function add($id)
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

        Cart::add($service->id, $service->name, 1, $service->price, '0', ['duration' => $service->duration]);
    }

    public static function remove($id)
    {
        $item = Cart::content()->where('id', $id)->first();
        if (isset($item)) {
            Cart::remove($item->rowId);
        }
    }
}
