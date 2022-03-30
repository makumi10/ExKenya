<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class CompleteRegistration extends Component
{
    public $counties = ["Nairobi", "Kiambu", "Nyeri", "Kirinyaga", "Nyandarua", "Muranga", "Nakuru", "Turkana",  "West Pokot",  "Samburu", "Trans Nzoia", "Uasin Gishu", "Elgeyo-Marakwet", "Nandi", "Baringo", "Laikipia", "Narok", "Kajiado" , "Kericho", "Bomet", "Mombasa","Taita Taveta", "Lamu", "Tana River", "Kilifi", "Kwale", "Wajir", "Garissa", "Mandera", "Kakamega",  "Vihiga", "Bungoma", "Busia", "Marsabit", "Isiolo", "Meru", "Tharaka-Nithi", "Embu", "Kitui", "Machakos", "Makueni", "Siaya", "Kisumu", "Homabay", "Migori", "Kisii", "Nyamira", "Not a Kenyan Citizen" ];
    public $first_name ;
    public $last_name ;
    public $county ;
    public $city ;
    public $about ;
    public $age ;
    public $image= 'default.jpg' ;

    protected $rules = [
        'first_name' => 'required|min:4',
        'last_name' => 'required|min:4',
        'county' => 'required',
        'city' => 'required',
        'about' => 'required',
        'age' => 'required|integer',
    ];

    public function addDetails()
    {
        // dd(auth()->user()->details);
        $data = $this->validate();
        $user_details = auth()->user()->details()->create($data);
        return redirect()->route('dashboard');
    }
    public function render()
    {
        return view('livewire.user.complete-registration');
    }
}
