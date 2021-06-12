<?php

namespace App\Http\Livewire\Intranet\Salons;

use App\Models\Salon;
use App\Models\SalonImage;
use App\Models\Timetable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SalonShow extends Component
{
    use WithFileUploads, AuthorizesRequests;

    public $title;
    public $salon;
    public $columns;
    public $images;
    public $newImages = [];
    public SalonImage $salonImage;
    public Timetable $timetable;


    public function rules()
    {
        return [
            'timetable.monday_start' => 'nullable|string',
            'timetable.monday_end' => 'nullable|string',
            'timetable.tuesday_start' => 'nullable|string',
            'timetable.tuesday_end' => 'nullable|string',
            'timetable.wednesday_start' => 'nullable|string',
            'timetable.wednesday_end' => 'nullable|string',
            'timetable.thursday_start' => 'nullable|string',
            'timetable.thursday_end' => 'nullable|string',
            'timetable.friday_start' => 'nullable|string',
            'timetable.friday_end' => 'nullable|string',
            'timetable.saturday_start' => 'nullable|string',
            'timetable.saturday_end' => 'nullable|string',
            'timetable.sunday_start' => 'nullable|string',
            'timetable.sunday_end' => 'nullable|string',
            'salonImage.path' => 'nullable|string',
            'salonImage.salon_id' => 'nullable',
            'newImages.*' => 'image'
        ];
    }

    public function mount(Salon $salon)
    {
        $this->title = $salon->name;
        $this->salon = $salon;
        $this->columns = DB::getSchemaBuilder()->getColumnListing('timetables');
        $this->images = $salon->getImages;

        if(isset($salon->getTimetable)) $this->timetable = $salon->getTimetable;
    }


    public function render()
    {
        $this->authorize('view', $this->salon);
        return view('livewire.intranet.salons.salon-show')->layout('layouts.intranet');
    }

    public function editTimetable()
    {
        $this->validate();
        $this->timetable->save();
        $this->emitSelf('timetable-saved');
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

                $this->emitSelf('image-saved');
            }
        }
    }
}
