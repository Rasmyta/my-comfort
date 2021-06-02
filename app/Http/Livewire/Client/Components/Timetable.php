<?php

namespace App\Http\Livewire\Client\Components;

use Livewire\Component;

class Timetable extends Component
{
    public $timetable;

    public function mount($timetable)
    {
        $this->timetable = $timetable;
    }

    public function render()
    {
        return view('livewire.client.components.timetable');
    }
}
