<?php

namespace App\View\Components\Molecules\Ui\GroupButtons;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $wireClick, $label, $active;

    public function __construct($wireClick = null, $label = null, $active = null)
    {
        $this->wireClick = $wireClick;
        $this->label = $label;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.ui.group-buttons.button');
    }
}
