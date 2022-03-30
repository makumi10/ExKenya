<?php

namespace App\Http\Livewire;

use App\Models\County;
use Livewire\Component;
use Livewire\WithPagination;

class CountyFeature extends Component
{
    use WithPagination;

    public $CountyId;

    public $icon;
    public $type;
    public $routeName;

    public function mount($type)
    {
        // \dd($this->CountyId);
        $this->type = $type;
        if ($type === 'cities') {
            $this->icon = 'fas fa-building';
            $this->routeName = 'user.city';
        }elseif ($type === 'hotels') {
            $this->icon = 'fas fa-h-square';
            $this->routeName = 'user.hotel';
        }elseif ($type === 'restaurants') {
            $this->routeName = 'user.restaurant';
            $this->icon = 'fas fa-utensils'; 
        }elseif($type === 'points of interest'){
            $this->routeName = 'user.poi';
        }
    }

    public function render()
    {
        // i don't think that this is the best approach
        // but i changed  it so we can paginate data
        $county =County::find($this->CountyId);
        if ( $this->type === 'cities') {
            $countyObjects = $county->cities()->paginate(8);
        }elseif ( $this->type === 'hotels') {
            $countyObjects = $county->hotels()->paginate(8);
        }elseif ( $this->type === 'restaurants') {
            $countyObjects = $county->restaurants()->paginate(8);
        }else if ($this->type === 'points of interest'){
            $countyObjects = $county->pointsOfInterest()->paginate(8);
        }
        return view('livewire.county-feature' , ['collection'=> $countyObjects]);
    }
}
