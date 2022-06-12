<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Search extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wireModel;

    public function __construct($wireModel)
    {
        //
        $this->wireModel = $wireModel;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.search');
    }
}
