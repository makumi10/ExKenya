<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class UpdateProfile extends Component
{

    public $counties = ["Nairobi", "Kiambu", "Nyeri", "Kirinyaga", "Nyandarua", "Muranga", "Nakuru", "Turkana",  "West Pokot",  "Samburu", "Trans Nzoia", "Uasin Gishu", "Elgeyo-Marakwet", "Nandi", "Baringo", "Laikipia", "Narok", "Kajiado" , "Kericho", "Bomet", "Mombasa","Taita Taveta", "Lamu", "Tana River", "Kilifi", "Kwale", "Wajir", "Garissa", "Mandera", "Kakamega",  "Vihiga", "Bungoma", "Busia", "Marsabit", "Isiolo", "Meru", "Tharaka-Nithi", "Embu", "Kitui", "Machakos", "Makueni", "Siaya", "Kisumu", "Homabay", "Migori", "Kisii", "Nyamira", "Not a Kenyan Citizen" ];

    public $user;
    public $name;
    public $email;
    public $password;
    public $passwordConfirm;
    public $first_name;
    public $last_name;
    public $image;
    public $current_image;
    public $about;
    public $county;
    public $city;
    public $age;
    public $postsCount;
    public $commentsCount;
    use WithFileUploads;

    public function mount(User $user)
    {

        $this->name = $user->name;
        $this->email = $user->email;
        if ($user->details) {
            $this->first_name = $user->details->first_name;
            $this->last_name = $user->details->last_name;
            $this->current_image = $user->details->image;
            $this->about = $user->details->about;
            $this->county = $user->details->county;
            $this->city = $user->details->city;
            $this->age = $user->details->age;
        }
        $this->postsCount = $user->posts()->count();
        $this->commentsCount = $user->comments()->count();
    }


    public function saveMainDetails()
    {
        // to stop function from working every time i press savec
        // bad approach i guess 
        if (!$this->password && $this->user->name === $this->name && $this->email === $this->user->email) {
            return;
        }

        $this->validate([
            'name' => 'required',
            'email' => 'email|required',
        ]);


        if ($this->password == '') {
            $data = ['name' => $this->name, 'email' =>  $this->email];
        } else {
            if ($this->password  === $this->passwordConfirm) {
                $this->password = bcrypt($this->password);
            } else {
                $this->addError('password', 'password confirmation doesn\'t match');
                return;
            }
            $data = ['name' => $this->name, 'email' =>  $this->email,  'password' =>  $this->password];
        }
        $this->user->update($data);
        $this->emit('profile-updated');
        return redirect()->route('dashboard');
    }


    public function saveAddtionalDetails()
    {
        // to stop function from working every time i press savec
        // bad approach i guess 
        if (
            $this->user->details &&
            !$this->image &&
            $this->first_name === $this->user->details->first_name &&
            $this->last_name === $this->user->details->last_name &&
            $this->about === $this->user->details->about &&
            $this->county === $this->user->details->county &&
            $this->city === $this->user->details->city &&
            $this->age === $this->user->details->age
        ) {
            return;
        }

        $data = $this->validate([
            'first_name' =>  'required|min:3',
            'last_name' =>  'required|min:3',
            'image' =>  'sometimes',
            'county' => 'sometimes',
            'city' => 'required',
            'about' => 'sometimes',
            'age' => 'integer|required',
        ]);
        // if user provided no image but he already have an image
        if (!$this->image && $this->current_image) {
            $data['image'] =  $this->current_image;
            // if user provided no image
        } else if ($data['image'] === null) {
            $data['image'] = 'default.jpg';
        } else {
            // if user provided an image 
            $data['image'] = $this->image->hashName();
            $this->image->store('public/Users');
            $this->reset('image');
        }

        if (!$this->user->details) {
            $this->user->details()->create($data);
        } else {
            $this->user->details()->update($data);
        }
        $this->emit('profile-updated');
    }



    public function render()
    {
        return view('livewire.user.update-profile');
    }
}
