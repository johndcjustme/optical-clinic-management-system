<?php

namespace App\View\Components\Atoms\Ui;

use Illuminate\View\Component;

class Btn extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wireClick;

    public function __construct($wireClick = null)
    {
        $this->wireClick = $wireClick;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.ui.btn');
    }
}
