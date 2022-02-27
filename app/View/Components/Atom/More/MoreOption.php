<?php

namespace App\View\Components\Atom\More;

use Illuminate\View\Component;

class MoreOption extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wireClick;
    public $optionName;
    
    public function __construct($wireClick, $optionName)
    {
        $this->wireClick = $wireClick;
        $this->optionName = $optionName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atom.more.more-option');
    }
}
