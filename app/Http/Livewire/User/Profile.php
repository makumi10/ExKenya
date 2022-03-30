<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Profile extends Component
{
    public $userHasDetials;
    public $firstName;
    public $lastName;
    public $image;
    public $about;
    public $age;
    public $postsCount;
    public $county;
    public $city;
    public $reviewCount;
    public $user;

    protected $listeners = ['profile-updated' => 'getUserData'];
    
   
    public function mount()
    {
      $this->getUserData();
    }


    public function getUserData()
    {
        if ($this->user->details) {
            $this->userHasDetials = true;
            $this->firstName = $this->user->details->first_name;
            $this->lastName = $this->user->details->lastName;
            $this->image = $this->user->details->image;
            $this->county = $this->user->details->county;
            $this->city = $this->user->details->city;
            $this->about = $this->user->details->about;
            $this->age = $this->user->details->age;
        }
        $this->postsCount = $this->user->posts()->count();
        $this->reviewCount = $this->user->reviews()->count();
    }
    public function render()
    {
        return view('livewire.user.profile');
    }
}
