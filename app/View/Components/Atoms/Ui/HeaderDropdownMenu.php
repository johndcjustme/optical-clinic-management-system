<?php

namespace App\View\Components\Atoms\Ui;

use Illuminate\View\Component;

class HeaderDropdownMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wireClose;

    public function __construct($wireClose = null)
    {
        $this->wireClose = $wireClose;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.ui.header-dropdown-menu');
    }
}
