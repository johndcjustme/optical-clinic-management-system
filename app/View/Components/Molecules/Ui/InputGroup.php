<?php

namespace App\View\Components\Molecules\Ui;

use Illuminate\View\Component;

class InputGroup extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wireModel, $placeholder;

    public function __construct($wireModel = null, $placeholder = null)
    {
        $this->wireModel = $wireModel; 
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.ui.input-group');
    }
}
