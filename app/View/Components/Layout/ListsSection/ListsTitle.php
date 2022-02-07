<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class ListsTitle extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $listFor;

    public function __construct($listFor)
    {
        $this->listFor = $listFor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.lists-section.lists-title');
    }
}
