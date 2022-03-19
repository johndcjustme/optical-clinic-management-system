<?php

namespace App\View\Components\Atom;

use Illuminate\View\Component;

class ColumnTitle extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wireClick;
    public $colTitle;
    public $arrowDirection;

    public function __construct($wireClick = null, $colTitle = null, $arrowDirection = null)
    {
        //
        $this->wireClick = $wireClick;
        $this->colTitle = $colTitle;
        $this->arrowDirection = $arrowDirection;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */


    public function render()
    {
        return view('components.atom.column-title');
    }
}
