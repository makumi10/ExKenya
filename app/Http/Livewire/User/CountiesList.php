<?php

namespace App\Http\Livewire\User;

use App\Models\County;
use Livewire\Component;
use Livewire\WithPagination;

class CountiesList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.user.counties-list' , ['counties' => County::paginate(6)]);
    }
}
