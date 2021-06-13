<?php

namespace App\Http\Livewire\Intranet\Reservations;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Models\Reservation;
use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class ReservationIndex extends Component
{
    use WithPagination, WithBulkActions, AuthorizesRequests;

    public $title = 'Reservas';
    public $search = "";
    public $perPage = 10;
    public $showFilters = false;
    public $filters = [
        'search' => '',
        'date-min' => null,
        'date-max' => null,
        'time-min' => null,
        'time-max' => null,
    ];

    public function render()
    {
        return view('livewire.intranet.reservations.reservation-index', ['reservations' => $this->rows])->layout('layouts.intranet');
    }

    public function getRowsQueryProperty()
    {
        if (Auth::user()->getRole->name === 'admin') {
            $query = Reservation::query()
                ->when($this->filters['search'], fn ($query, $search) => $query->where('id', $search))
                ->when($this->filters['date-min'], fn ($query, $date) => $query->where('date', '>=', $date))
                ->when($this->filters['date-max'], fn ($query, $date) => $query->where('date', '<=', $date))
                ->when($this->filters['time-min'], fn ($query, $time) => $query->where('time', '>=', $time))
                ->when($this->filters['time-max'], fn ($query, $time) => $query->where('time', '<=', $time))
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc');
        } else {
            $query = Reservation::query()
                ->where('salon_id', Auth::user()->getSalon->id)
                ->when($this->filters['search'], fn ($query, $search) => $query->where('id', $search))
                ->when($this->filters['date-min'], fn ($query, $date) => $query->where('date', '>=', $date))
                ->when($this->filters['date-max'], fn ($query, $date) => $query->where('date', '<=', $date))
                ->when($this->filters['time-min'], fn ($query, $time) => $query->where('time', '>=', $time))
                ->when($this->filters['time-max'], fn ($query, $time) => $query->where('time', '<=', $time))
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc');
        }

        return $query;
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate($this->perPage);
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
        }, 'reservas.csv');
    }

}
