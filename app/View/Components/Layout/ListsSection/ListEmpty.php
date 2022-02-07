<?php

namespace App\View\Components\Layout\ListsSection;

use Illuminate\View\Component;

class ListEmpty extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $emptyMessage;

    public function __construct($emptyMessage)
    {
        $this->emptyMessage = $emptyMessage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.lists-section.list-empty');
    }
}
