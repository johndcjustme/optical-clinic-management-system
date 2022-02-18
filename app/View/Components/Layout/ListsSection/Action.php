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

    public $itemId;
    public $wireClickEdit;
    public $wireClickDelete;
    public $photo;
    
    public function __construct($itemId, $wireClickEdit, $wireClickDelete, $photo)
    {
        $this->itemId = $itemId;
        $this->wireClickEdit = $wireClickEdit;
        $this->wireClickDelete = $wireClickDelete;
        $this->photo = $photo;
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
