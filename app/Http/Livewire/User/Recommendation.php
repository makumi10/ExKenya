<?php

namespace App\Http\Livewire\User;

use App\Models\County;
use Livewire\Component;

class Recommendation extends Component
{
    public $regions;
    public $weatherOptions;

    public $userBudget;
    public $userRegionChoice;
    public $userWeatherPrefrence;
    public $destinationProp;

    public $userDestinationIsFamousFor= ['shopping', 'beaches', 'Tourist Attractions'];
    
    public $budgetForQuery;
    public $recommendedCounty;
    public $message;

    protected $rules = [
        'userBudget' => 'required|integer|min:1200',
        'userRegionChoice' => 'required',
        'userWeatherPrefrence' => 'required',
        'destinationProp' => 'required',
    ];
    protected $messages = [
        'userBudget.min' => 'The budget can\'t be lower than 1200$',
        'userRegionChoice.required' => 'help us to reduce the choices',
        'userWeatherPrefrence.required' => 'choose a weather you prefer for destination',
    ];

    public function mount()
    {
        $this->regions = County::groupBy('region')->pluck('region')->toArray();
        $this->weatherOptions = County::groupBy('weather_flag')->pluck('weather_flag')->toArray();
    }

    public function updateduserRegionChoice()
    {
        $this->weatherOptions = County::where('region' , '=' , $this->userRegionChoice)->groupBy('weather_flag')->pluck('weather_flag');
    }

    public function recommend()
    {
        $this->recommendedCounty = null;
        $this->message = '';
        $this->validate();
        $this->checkBudget();

        //perfect match case
        $this->recommendedCounty = County::where('region', '=', $this->userRegionChoice)
        ->where('weather_flag', '=', $this->userWeatherPrefrence)
        ->where('budget_flag', '=', $this->budgetForQuery)
        ->where('known_for' , '=' , $this->destinationProp)
        ->get()->first();
        // dd($this->recommendedCounty);
        
        if ($this->recommendedCounty === null) {
            $this->recommendedCounty = County::where('region', '=', $this->userRegionChoice)
            ->where('weather_flag', '=', $this->userWeatherPrefrence)
            ->where('known_for' , '=' , $this->destinationProp)
            ->get()
            ->first();
            $this->message = 'some of your criteria didn\'t match (budget) , but this was the best option';
        }


        if ($this->recommendedCounty === null) {
            $this->recommendedCounty = County::where('region', '=', $this->userRegionChoice)
            ->where('weather_flag', '=', $this->userWeatherPrefrence)->get()->first();
            $this->message = 'some of your criteria didn\'t match , but this was the best option';
        }
    }
    public function checkBudget()
    {
        if ($this->userBudget < 1500) {
            $this->budgetForQuery = 'low';
        } elseif ($this->userBudget > 1500 && $this->userBudget <= 5000) {
            $this->budgetForQuery = 'medium';
        } else {
            $this->budgetForQuery = 'expensive';
        }
    }

    public function render()
    {
        return view(
            'livewire.user.recommendation',
            [
                'weatherOptions' => $this->weatherOptions
            ]
        );
    }
}
