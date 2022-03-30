<?php

namespace App\Http\Livewire\Admins;

use App\Models\Image;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\PointOfInterest;

class CountyPoi extends Component
{
    use WithPagination;
    public $county;
    public $name;
    public $longtiude;
    public $latitude;
    public $details;
    public $cost;
    public $working_hours;
    public $newphotos;

    public $currentPOI;
    public $POIImages;
    use WithFileUploads;

    protected $rules = [
        'name' => 'required',
        'longtiude' => 'required',
        'latitude' => 'required',
        'details' => 'required',
        'cost' => 'required',
        'working_hours' => 'required',

    ];

    public function storeModal()
    {
        $this->reset(['name', 'longtiude', 'latitude', 'details', 'cost', 'working_hours']);
        $this->resetValidation();
    }

    public function store()
    {
        $data = $this->validate();
        $POI = $this->county->pointsOfInterest()->create($data);
        $this->handleImages($POI);
        $this->dispatchBrowserEvent('close-modal');
        $this->reset(['name', 'longtiude', 'latitude', 'details', 'cost', 'working_hours']);
    }
    public function updateModal($id)
    {
        $POI = PointOfInterest::find($id);
        $this->currentPOI = $POI;
        $this->name = $POI->name;
        $this->longtiude = $POI->longtiude;
        $this->latitude = $POI->latitude;
        $this->cost = $POI->cost;
        $this->details = $POI->details;
        $this->working_hours = $POI->working_hours;
    }
    public function update()
    {
        $data = $this->validate();
        $this->currentPOI->update($data);
        $this->handleImages($this->currentPOI);
        $this->dispatchBrowserEvent('close-modal');
    }
    public function DeleteImage($id)
    {
        $image = Image::find($id);
        $image->delete();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function Delete($id)
    {
        $POI = PointOfInterest::find($id);
        $POI->images()->delete();
        $POI->delete();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function POIImages($id)
    {
        $POI = PointOfInterest::find($id);
        $this->POIImages = $POI->images;
    }
    private function handleImages($POI)
    {
        if (!empty($this->newphotos)) {
            $this->validate([
                'newphotos.*' => 'image',
            ]);
            foreach ($this->newphotos as $photo) {
                $POI->images()->create(['file_name' => $photo->hashName()]);
                $photo->store('public/POI');
            }
        }
    }
    public function render()
    {
        $countyPois = $this->county->PointsOfInterest()->paginate(5);
        return view('livewire.admins.county-poi', [
            'countyPois' => $countyPois
        ]);
    }
}