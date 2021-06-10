<?php

namespace App\Http\Livewire\Intranet\Users;

use App\Http\Livewire\Traits\WithSorting;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination, WithSorting, WithBulkActions;

    public $search = "";
    public $deleteId = "";
    public $titleModal = "";
    public $title = "Usuarios";
    public $perPage = 10;
    public $showFilters = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public Collection $roles;
    public User $editing;
    public $filters = [
        'search' => '',
        'email' => '',
        'phone' => '',
        'role_id' => ''
    ];
    protected $queryString = ['sortField', 'sortDirection'];

    public function rules()
    {
        return [
            'editing.name' => 'required',
            'editing.surname' => 'required',
            'editing.email' => 'required|email:rfc,filter',
            'editing.phone' => 'required|max:20',
            'editing.role_id' => 'required|numeric'
        ];
    }

    public function mount()
    {
        $this->roles = Role::all();
        $this->editing = $this->makeBlankUser();
    }

    public function render()
    {
        return view('livewire.intranet.users.user-index', ['users' => $this->rows])->layout('layouts.intranet');
    }

    public function getRowsQueryProperty()
    {
        $query = User::query()
            ->when($this->filters['search'], fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%')) // surname ???
            ->when($this->filters['email'], fn ($query, $email) => $query->where('email', 'like', '%' . $email . '%'))
            ->when($this->filters['phone'], fn ($query, $phone) => $query->where('phone', $phone))
            ->when($this->filters['role_id'], fn ($query, $role) => $query->where('role_id', $role))
            ->orderBy($this->sortField, $this->sortDirection);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate($this->perPage);
    }

    public function create()
    {
        // If object has a key, then it is in the DB and we can safely overwrite it.
        if ($this->editing->getKey()) $this->editing = $this->makeBlankUser();

        $this->titleModal = "Crear User";
        $this->showEditModal = true;
    }

    public function edit(User $user)
    {
        // If 'editing' is not equal to object passed as parameter, then we can override 'editing'.
        if ($this->editing->isNot($user)) $this->editing = $user;

        $this->titleModal = "Editar Usuario";
        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->showEditModal = false;
    }

    public function delete($userId)
    {
        $this->showDeleteModal = true;
        $this->deleteId = $userId;
    }

    public function deleteConfirm()
    {
        User::findOrFail($this->deleteId)->delete();
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
        }, 'usuarios.csv');
    }

    private function makeBlankUser()
    {
        return User::make();
    }
}
