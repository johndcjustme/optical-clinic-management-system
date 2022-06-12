<?php

namespace App\View\Components\Atom\Alert;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $type;
    public $has;
    public $color;
    public $bg_color;
    
    public function __construct($type, $has)
    {
        $this->type = $type; 
        $this->has = $has;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atom.alert.alert');
    }
}
