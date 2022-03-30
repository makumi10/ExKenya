<?php

namespace App\Http\Livewire;

use Livewire\Component;


class ModelTemplate extends Component
{
   
    // GOLBALS
    public $object;
    public $type;
    public $imagesFolder;
    public $longtiude;
    public $latitude;
    public $name;
    public $objectImages;
    public $details;
    public $weather;
    public $zoomLevel;


    // reviews
    public $modelType;


    
    // Counties
    public $placeLocation;
    public $POI;
    public $cities;
    public $restaurants;
    public $hotels;
    public $population;
    // public $currency;
    public $budget;



    // Point of interest

    public $cost;
    public $workingHours;
    
    // hotels
    public $rate;
    public $price;

    public function mount($type , $object)
    {
        $this->object = $object;
        $this->type = $type;
        $this->name = $object->name;
        $this->longtiude = $object->longtiude;
        $this->latitude = $object->latitude;
        $this->objectImages =$object->images;
        $this->details = $object->details;

        if ($type === 'county') {
            $this->imagesFolder = 'counties';
            $this->modelType = 'App\Models\County';
            $this->zoomLevel = 7;
            $this->placeLocation = $object->region;
            $this->POI = $object->pointsOfInterest;
            $this->cities = $object->cities;
            $this->restaurants = $object->restaurants;
            $this->hotels = $object->hotels;
            $this->population =$object->population;
            //$this->currency =$object->currency;
            $this->weather =$object->weather;
            $this->budget =$object->budget;
        } elseif ($type === 'city') {
            $this->imagesFolder = 'cities';
            $this->modelType = 'App\Models\City';
            $this->hotels = $object->county->hotels;
            $this->zoomLevel = 12;
            $this->placeLocation = $object->county->name;
            $this->weather =$object->weather;
            
        }elseif ($type === 'POI') {
            $this->imagesFolder = 'POI';
            $this->modelType = 'App\Models\PointOfInterest';
            $this->hotels = $object->county->hotels;
            $this->zoomLevel = 12;
            $this->placeLocation = $object->county->name;
            $this->cost = $object->cost;
            $this->workingHours = $object->working_hours;
        }elseif ($type === 'hotel') {
            $this->imagesFolder = 'hotels';
            $this->modelType = 'App\Models\Hotel';
            $this->POI = $object->county->pointsOfInterest;
            $this->restaurants = $object->county->restaurants;
            $this->cities = $object->county->cities;
            $this->hotels = $object->county->hotels;
            $this->zoomLevel = 12;
            $this->placeLocation = $object->county->name;
            $this->rate = $object->rate;
            $this->price = $object->price;
        }else{
            $this->imagesFolder = 'resturants';
            $this->modelType = 'App\Models\Restaurant';
            $this->zoomLevel = 12;
            $this->placeLocation = $object->county->name;
            $this->rate = $object->rate;
            $this->hotels = $object->county->hotels;
        }
    }



    public function render()
    {
        return view('livewire.model-template');
    }
}
