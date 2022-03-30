<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\County as CountyModel;
class County extends Component
{

    public $county;
    public function mount($id)
    {
        $this->county = CountyModel::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.user.county');
    }
}
