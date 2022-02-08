<?php

namespace App\View\Components\Layout\ListsSection;

use Illuminate\View\Component;

class Action extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $deleteId;
    public $wireClick;
    
    public function __construct($deleteId, $wireClick)
    {
        $this->deleteId = $deleteId;
        $this->wireClick = $wireClick;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.lists-section.action');
    }
}
