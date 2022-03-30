<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ObjectContainer extends Component
{
    public $collection;
    public $type;
    public $header;
    public $singleItemRoute;
    public $itemListRoute;
    public $text;
    public $setItemLocation = false;

    public function mount()
    {
        $this->header = 'Discover Your Next Destination ..';
        $this->text = 'a list of our most viewed {{$type}}';
        if ($this->type === 'counties') {
            $this->text = 'Among our listed counties .. ';
            $this->singleItemRoute = 'user.county';
            $this->itemListRoute = 'user.counties';
        }else if($this->type === 'cities'){
            $this->setItemLocation = true;
            $this->text = 'A list of our most viewed cities and towns ';
            $this->singleItemRoute = 'user.city';
            $this->itemListRoute = 'user.cities';
        }else if($this->type === 'hotels'){
            $this->setItemLocation = true;
            $this->text = 'A list of our supported top rated hotels';
            $this->singleItemRoute = 'user.hotel';
            $this->itemListRoute = 'user.hotels';
        }else if($this->type === 'pois'){
            $this->setItemLocation = true;
            $this->text = 'A list of our Point of Interest locations';
            $this->singleItemRoute = 'user.poi';
            $this->itemListRoute = 'user.pois';
        }else if($this->type === 'restaurants'){
            $this->setItemLocation = true;
            $this->text = 'A list of our supported ,  top rated restaurants ';
            $this->singleItemRoute = 'user.restaurant';
            $this->itemListRoute = 'user.restaurants';
        }
    }
    public function render()
    {
        return view('livewire.object-container');
    }
}
