<?php

namespace App\View\Components\Atom;

use Illuminate\View\Component;

class BtnCircle extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wireClick;

    public function __construct($wireClick)
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
        return view('components.atom.btn-circle');
    }
}
