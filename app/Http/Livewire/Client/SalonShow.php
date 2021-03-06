<?php

namespace App\Http\Livewire\Client;

use App\Models\Salon;
use App\Models\SalonImage;
use App\Models\Timetable;
use Livewire\Component;
use Log;

class SalonShow extends Component
{

    public $title;
    public $salon;
    public $images;
    public SalonImage $salonImage;
    public Timetable $timetable;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount($salonId)
    {
        $this->salon = Salon::findOrFail($salonId);
        $this->title = $this->salon->name;
        $this->images = $this->salon->getImages;

        if (isset($this->salon->getTimetable)) {
            $this->timetable = $this->salon->getTimetable;
        }
    }

    public function render()
    {
        return view('livewire.client.salon-show')->layout('layouts.app');
    }

    public function removeCartItem($id)
    {
        Log::info('Emitting removeCartItem ', ['id' => $id]);
        $this->emitTo('client.components.service-component', 'removeCartItem', $id);
    }
}
