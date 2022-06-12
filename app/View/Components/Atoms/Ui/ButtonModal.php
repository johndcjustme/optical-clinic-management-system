<?php

namespace App\View\Components\Atoms\Ui;

use Illuminate\View\Component;

class ButtonModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $label, $icon, $wireClick, $for;

    public function __construct($label = null, $icon = null, $wireClick = null, $for = null)
    {
        $this->label = $label; 
        $this->icon = $icon;
        $this->wireClick = $wireClick;
        $this->for = $for;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.ui.button-modal');
    }
}
