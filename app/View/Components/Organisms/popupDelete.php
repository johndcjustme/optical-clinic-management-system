<?php

namespace App\View\Components\Organisms;

use Illuminate\View\Component;

class popupDelete extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $itemId;
    public $wireClick;
    
    public function __construct($itemId, $wireClick)
    {
        $this->itemId = $itemId;
        $this->wireClick = $wireClick;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.popup-delete');
    }
}
