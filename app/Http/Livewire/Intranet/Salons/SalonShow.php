<?php

namespace App\Http\Livewire\Intranet\Salons;

use App\Models\Salon;
use App\Models\SalonImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SalonShow extends Component
{
    use WithFileUploads;

    public $title;
    public $salon;
    public $columns;
    public $timetable;
    public $images;
    public $newImages = [];
    public SalonImage $salonImage;


    public function rules()
    {
        return [
            'salonImage.path' => 'required|string',
            'salonImage.salon_id' => 'required',
            'newImages.*' => 'image'
        ];
    }

    public function mount(Salon $salon)
    {
        $this->title = $salon->name;
        $this->salon = $salon;
        $this->columns = DB::getSchemaBuilder()->getColumnListing('timetables');
        $this->images = $salon->getImages;
    }


    public function render()
    {
        return view('livewire.intranet.salons.salon-show')->layout('layouts.intranet');
    }

    public function saveImages()
    {
        if ($this->newImages) {

            foreach ($this->newImages as $key => $image) {
                $rand = rand(10, 100);
                $this->salonImage = SalonImage::make([
                    'salon_id' => $this->salon->id,
                    'path' => 'a' . $rand
                ]);

                $this->validate();
                $this->salonImage->save();

                $this->salonImage->update([
                    'path' => Storage::disk('s3')->put('salons', $this->newImages)
                ]);

                $this->emitSelf('notify-saved');
            }
        }
    }
}
