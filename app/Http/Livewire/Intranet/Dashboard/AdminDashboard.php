<?php

namespace App\Http\Livewire\Intranet\Dashboard;

use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        return view('livewire.intranet.dashboard.admin-dashboard')->layout('layouts.intranet');
    }
}
