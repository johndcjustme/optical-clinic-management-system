<?php

namespace App\View\Components\Atom;

use Illuminate\View\Component;

class ProfilePhoto extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $size;
    public $path;

    public function __construct($size, $path)
    {
        $this->size = $size;
        $this->path = $path;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atom.profile-photo');
    }
}
