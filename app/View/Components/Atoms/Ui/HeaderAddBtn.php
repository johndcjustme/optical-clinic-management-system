<?php

namespace App\View\Components\Atoms\Ui;

use Illuminate\View\Component;

class HeaderAddBtn extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wireClick, $label;

    public function __construct($wireClick = null, $label = null)
    {
        $this->wireClick = $wireClick;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.ui.header-add-btn');
    }
}
