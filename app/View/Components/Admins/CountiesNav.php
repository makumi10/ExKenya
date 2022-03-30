<?php

namespace App\View\Components\Admins;

use Illuminate\View\Component;

class CountiesNav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $CountyId;

    public function __construct($id)
    {
        $this->CountyId = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.admins.counties-nav');
    }
}