<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $minWidth, $maxWidth;
    public function __construct($minWidth = '250px', $maxWidth = '40em')
    {
        $this->minWidth = $minWidth;
        $this->maxWidth = $maxWidth;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.modal');
    }
}
