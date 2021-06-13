<?php

namespace App\Http\Livewire\Intranet\Services;

use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Models\Category;
use App\Models\Salon;
use App\Models\Service;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceIndex extends Component
{
    use WithPagination, WithSorting, WithBulkActions, AuthorizesRequests;

    public $search = "";
    public $deleteId = "";
    public $titleModal = "";
    public $title = "Servicios";
    public $perPage = 10;
    public $showFilters = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public Collection $categories;
    public Collection $salons;
    public Service $editing;
    public $filters = [
        'search' => '',
        'duration-min' => null,
        'duration-max' => null,
        'price-min' => null,
        'price-max' => null,
        'category_id' => '',
        'salon_id' => '',
    ];

    protected $queryString = ['sortField', 'sortDirection'];

    public function rules()
    {
        return [
            'editing.name' => 'required',
            'editing.duration' => 'required|numeric',
            'editing.subcategory' => 'nullable',
            'editing.description' => 'nullable',
            'editing.price' => 'required|numeric',
            'editing.salon_id' => 'required|numeric',
            'editing.category_id' => 'required|numeric',
        ];
    }

    public function mount()
    {
        $this->categories = Category::all();
        $this->salons = Salon::all();
        $this->editing = $this->makeBlankService();
    }

    public function render()
    {
        return view('livewire.intranet.services.service-index', ['services' => $this->rows, 'salons' => $this->salons])
            ->layout('layouts.intranet');
    }

    public function getRowsQueryProperty()
    {
        if (Auth::user()->getRole->name === 'admin') {
            $query = Service::query()
                ->when($this->filters['search'], fn ($query, $search) => $query->where(DB::raw('lower(name)'), 'like', '%' . strtolower($search) . '%'))
                ->when($this->filters['duration-min'], fn ($query, $duration) => $query->where('duration', '>=', $duration))
                ->when($this->filters['duration-max'], fn ($query, $duration) => $query->where('duration', '<=', $duration))
                ->when($this->filters['price-min'], fn ($query, $price) => $query->where('price', '>=', $price))
                ->when($this->filters['price-max'], fn ($query, $price) => $query->where('price', '<=', $price))
                ->when($this->filters['category_id'], fn ($query, $category) => $query->where('category_id', $category))
                ->when($this->filters['salon_id'], fn ($query, $salon) => $query->where('salon_id', $salon))
                ->orderBy($this->sortField, $this->sortDirection);
        }else{
            $query = Service::query()
                ->where('salon_id', Auth::user()->getSalon->id)
                ->when($this->filters['search'], fn ($query, $search) => $query->where(DB::raw('lower(name)'), 'like', '%' . strtolower($search) . '%'))
                ->when($this->filters['duration-min'], fn ($query, $duration) => $query->where('duration', '>=', $duration))
                ->when($this->filters['duration-max'], fn ($query, $duration) => $query->where('duration', '<=', $duration))
                ->when($this->filters['price-min'], fn ($query, $price) => $query->where('price', '>=', $price))
                ->when($this->filters['price-max'], fn ($query, $price) => $query->where('price', '<=', $price))
                ->when($this->filters['category_id'], fn ($query, $category) => $query->where('category_id', $category))
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
        // If object has a key, then it is in the DB and we can safely overwrite it.
        if ($this->editing->getKey()) $this->editing = $this->makeBlankService();

        if(isset(Auth::user()->getSalon)){
            $this->editing->salon_id = Auth::user()->getSalon->id;
        }

        $this->titleModal = "Crear Servicio";
        $this->showEditModal = true;
    }

    public function edit(Service $service)
    {
        // If 'editing' is not equal to 'salon' passed as parameter, then we can override 'editing'.
        if ($this->editing->isNot($service)) $this->editing = $service;

        $this->titleModal = "Editar Servicio";
        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->showEditModal = false;
    }

    public function delete($id)
    {
        $this->authorize('delete', Service::findOrFail($id));
        $this->showDeleteModal = true;
        $this->deleteId = $id;
    }

    public function deleteConfirm()
    {
        Service::findOrFail($this->deleteId)->delete();
        $this->deleteId = "";
        $this->showDeleteModal = false;
    }


    public function toggleShowFilters()
    {
        $this->showFilters = !$this->showFilters;
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
        }, 'servicios.csv');
    }

    private function makeBlankService()
    {
        return Service::make();
    }
}
