<?php

namespace App\Http\Livewire\Intranet\Salons;

use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Models\Activity;
use App\Models\Salon;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;
use Livewire\Component;
use Livewire\WithPagination;

class SalonIndex extends Component
{
    use WithPagination, WithSorting, WithBulkActions, AuthorizesRequests;

    public $search = "";
    public $deleteId = "";
    public $titleModal = "";
    public $title = "Salones";
    public $perPage = 10;
    public $showFilters = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $showNewSalons = false;
    public $showGenerateAccessModal = false;
    public Collection $activities;
    public Salon $editing;
    public User $manager;
    public $password;
    public $filters = [
        'search' => '',
        'city' => '',
        'user_id' => '',
        'activity_id' => ''
    ];
    protected $queryString = ['sortField', 'sortDirection'];

    public function rules()
    {
        return [
            'editing.name' => 'required',
            'editing.employees' => 'required|numeric|min:1',
            'editing.address' => 'required',
            'editing.city' => 'required',
            'editing.postal_code' => 'required|numeric',
            'editing.description' => 'nullable',
            'editing.activity_id' => 'required|numeric',
            'password' => ['required', 'string', new Password]
        ];
    }

    public function mount()
    {
        $this->activities = Activity::all();
        $this->editing = $this->makeBlankSalon();
    }

    public function render()
    {
        return view('livewire.intranet.salons.salon-index', ['salons' => $this->rows])->layout('layouts.intranet');
    }

    public function getRowsQueryProperty()
    {
        if (Auth::user()->getRole->name === 'admin') {
            $query = Salon::query()
            ->when($this->filters['activity_id'], fn ($query, $activity) => $query->where('activity_id', $activity))
            ->when($this->filters['city'], fn ($query, $city) => $query->where(DB::raw('lower(city)'), 'like', '%' . strtolower($city) . '%'))
            ->when($this->filters['search'], fn ($query, $search) => $query->where(DB::raw('lower(name)'), 'like', '%' . strtolower($search) . '%'))
            ->orderBy($this->sortField, $this->sortDirection);

            if ($this->showNewSalons) $query = Salon::getNewSalons()->orderBy($this->sortField, $this->sortDirection);
        }else{
            $query = Salon::query()
            ->where('user_id', Auth::id())
            ->when($this->filters['activity_id'], fn ($query, $activity) => $query->where('activity_id', $activity))
            ->when($this->filters['city'], fn ($query, $city) => $query->where(DB::raw('lower(city)'), 'like', '%' . strtolower($city) . '%'))
            ->when($this->filters['search'], fn ($query, $search) => $query->where(DB::raw('lower(name)'), 'like', '%' . strtolower($search) . '%'))
            ->orderBy($this->sortField, $this->sortDirection);
        }

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate($this->perPage);
    }


    public function create()
    {
        $this->authorize('create');
        // If object has a key, then it is in the DB and we can safely overwrite it.
        if ($this->editing->getKey()) $this->editing = $this->makeBlankSalon();

        $this->titleModal = "Crear Salon";
        $this->showEditModal = true;
    }

    public function edit(Salon $salon)
    {
        $this->authorize('update', $salon);
        // If 'editing' is not equal to 'salon' passed as parameter, then we can override 'editing'.
        if ($this->editing->isNot($salon)) $this->editing = $salon;

        $this->titleModal = "Editar Salon";
        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validateOnly('editing.*');
        $this->editing->save();
        $this->showEditModal = false;
    }

    public function delete($salonId)
    {
        $this->authorize('delete', Salon::findOrFail($salonId));
        $this->showDeleteModal = true;
        $this->deleteId = $salonId;
    }

    public function deleteConfirm()
    {
        Salon::findOrFail($this->deleteId)->delete();
        $this->deleteId = "";
        $this->showDeleteModal = false;
    }

    public function toggleShowFilters()
    {
        $this->showFilters = !$this->showFilters;
    }

    public function toggleShowNewSalons()
    {
        $this->showNewSalons = !$this->showNewSalons;
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    // Resets the page when the 'filters' are updated
    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function exportSelected()
    {
        return response()->streamDownload(function () {
            echo $this->selectedRowsQuery->toCsv();
        }, 'salones.csv');
    }

    private function makeBlankSalon()
    {
        return Salon::make();
    }


    /**
     * Create and asign new user to the salon
     */
    public function saveGenerateAccess()
    {
        $this->validateOnly('password');

        DB::table('users')
            ->where('id', $this->manager->id)
            ->update([
                'password' => Hash::make($this->password)
            ]);

        // envio de contrase??a al email de gestor

        $this->showGenerateAccessModal = false;
    }

    public function generateAccess(Salon $salon)
    {
        $this->manager = $salon->getManager;
        $this->titleModal = "Generar acceso para gestor";
        $this->showGenerateAccessModal = true;
    }
}
