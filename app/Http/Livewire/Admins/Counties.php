<?php

namespace App\Http\Livewire\Admins;

use App\Models\Image;
use App\Models\County;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Counties extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name;
    public $longtiude;
    public $latitude;
    public $region;
    public $details;
    public $weather;
    public $population;
    public $budget;
    public $budget_flag;
    public $weather_flag;
    public $newphotos = [];
    public $currentphotos = [];
    public $currentCounty;
    public $CountyImages;
    public $known_for;

    protected $rules = [
        'name' => 'required|unique:counties',
        'region' => 'required',
        'longtiude' => 'required',
        'latitude' => 'required',
        'details' => 'required',
        'weather' => 'required',
        'budget' => 'required',
        'population' => 'required',
        'budget_flag' => 'required',
        'weather_flag' => 'required',
        'known_for'=> 'required'
    ];

    public function storeModal()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function DeleteImage($id)
    {
        $image = Image::find($id);
        $image->delete();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function store()
    {
        $data = $this->validate();
        $county = County::create($data);

        $this->handleImages($county);

        $this->dispatchBrowserEvent('close-modal');
        $this->reset();
    }

    public function updateModal($id)
    {
        $county = County::find($id);
        $this->currentCounty = $county;
        $this->name = $county->name;
        $this->region = $county->region;
        $this->longtiude = $county->longtiude;
        $this->latitude = $county->latitude;
        $this->details = $county->details;
        $this->weather = $county->weather;
        $this->budget = $county->budget;
        $this->population = $county->population;
        $this->budget_flag = $county->budget_flag;
        $this->weather_flag = $county->weather_flag;
        $this->known_for = $county->known_for;
    }
    public function update()
    {
        $data = $this->validate([
            'name' => 'sometimes',
            'region' => 'sometimes',
            'longtiude' => 'sometimes',
            'latitude' => 'sometimes',
            'details' => 'sometimes',
            'weather' => 'sometimes',
            'budget' => 'sometimes',
            'population' => 'sometimes',
            'budget_flag' => 'sometimes',
            'weather_flag' => 'sometimes',
            'known_for' => 'sometimes'
        ]);
        $this->currentCounty->update($data);

        $this->handleImages($this->currentCounty);

        $this->dispatchBrowserEvent('close-modal');
    }


    public function Delete($id)
    {
        $county = County::find($id);
        $county->images()->delete();
        $county->delete();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function CountyImages($id)
    {
        $County = County::find($id);
        $this->CountyImages = $County->images;
    }


    private function handleImages($county)
    {
        if (!empty($this->newphotos)) {
            $this->validate([
                'newphotos.*' => 'image',
            ]);
            foreach ($this->newphotos as $photo) {
                $county->images()->create(['file_name' => $photo->hashName()]);
                $photo->store('public/counties');
            }
        }
    }

    public function render()
    {
        return view('livewire.admins.counties', [
            'counties' => County::paginate(5),
        ]);
    }
}