<?php

namespace App\View\Components\Atoms\Ui;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $placeholder;
    public $value;
    public $wireModel;

    public function __construct($placeholder = null, $value = null, $wireModel = null)
    {
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->wireModel = $wireModel;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.ui.input');
    }
}
