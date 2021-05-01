<?php

namespace App\Http\Livewire\Intranet\Salons;

use App\Http\Livewire\Traits\WithSorting;
use App\Models\Activity;
use App\Models\Salon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class SalonIndex extends Component
{
    use WithPagination, WithSorting;

    public $search = "";
    public $deleteId = "";
    public $titleModal = "";
    public $showEditModal = false;
    public $showDeleteModal = false;
    public Collection $activities;
    public Salon $editing;

    protected $queryString = ['sortField', 'sortDirection'];

    public function rules()
    {
        return [
            'editing.name' => 'required',
            'editing.employees' => 'required|numeric|min:1',
            'editing.address' => 'required',
            'editing.city' => 'required',
            'editing.postal_code' => 'required|numeric',
            'editing.description' => 'nullable|required',
            'editing.activity_id' => 'required|numeric'
        ];
    }

    public function mount()
    {
        $this->activities = Activity::all();
        $this->editing = $this->makeBlankSalon();
    }

    public function render()
    {
        $salons = Salon::search('name', $this->search)->orderBy($this->sortField, $this->sortDirection)->paginate(6);
        return view('livewire.intranet.salons.salon-index', ['salons' => $salons])->layout('layouts.intranet');
    }

    public function makeBlankSalon()
    {
        return Salon::make();
    }

    public function create()
    {
        // If object has a key, then it is in the DB and we can safely overwrite it.
        if ($this->editing->getKey()) $this->editing = $this->makeBlankSalon();

        $this->titleModal = "Crear Salon";
        $this->showEditModal = true;
    }

    public function edit(Salon $salon)
    {
        // If 'editing' is not equal to 'salon' passed as parameter, then we can override 'editing'.
        if ($this->editing->isNot($salon)) $this->editing = $salon;

        $this->titleModal = "Editar Salon";
        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->showEditModal = false;
    }

    public function delete($salonId)
    {
        $this->showDeleteModal = true;
        $this->deleteId = $salonId;
    }

    public function deleteConfirm()
    {
        Salon::findOrFail($this->deleteId)->delete();
        $this->deleteId = "";
        $this->showDeleteModal = false;
    }
}
