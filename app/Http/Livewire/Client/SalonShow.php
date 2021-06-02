<?php

namespace App\Http\Livewire\Client;

use App\Models\Salon;
use App\Models\SalonImage;
use App\Models\Timetable;
use Livewire\Component;

class SalonShow extends Component
{

    public $title;
    public $salon;
    public $images;
    public SalonImage $salonImage;
    public Timetable $timetable;

    public function mount($salonId)
    {
        $this->salon = Salon::findOrFail($salonId);
        $this->title = $this->salon->name;
        $this->timetable = $this->salon->getTimetable;
        $this->images = $this->salon->getImages;
    }

    public function render()
    {
        return view('livewire.client.salon-show')->layout('layouts.app');
    }
}
