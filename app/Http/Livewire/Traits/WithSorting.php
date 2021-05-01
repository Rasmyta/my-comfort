<?php

namespace App\Http\Livewire\Traits;

trait WithSorting
{
    public $sortField = "name";
    public $sortDirection = "asc";

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }
}
