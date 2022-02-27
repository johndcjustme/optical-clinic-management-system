<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class PanelSettings extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */    public $title;
    public $wireToggle;


    public function __construct($wireToggle)
    {
        $this->wireToggle = $wireToggle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.panel-settings');
    }

}
