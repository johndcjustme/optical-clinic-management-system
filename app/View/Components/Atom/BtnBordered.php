<?php

namespace App\View\Components\Atom;

use Illuminate\View\Component;

class BtnBordered extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $color;
    public $label;
    public $height;
    public $wireClick;

    public function __construct($color, $label, $height, $wireClick)
    {
        $this->color = $color;
        $this->label = $label;
        $this->height = $height;
        $this->wireClick = $wireClick;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atom.btn-bordered');
    }
}
