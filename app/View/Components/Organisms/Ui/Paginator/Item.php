<?php

namespace App\View\Components\Organisms\Ui\Paginator;

use Illuminate\View\Component;

class Item extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $value, $wireClick;
    public function __construct($value, $wireClick)
    {
        $this->vlaue = $value;
        $this->wireClick = $wireClick;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.ui.paginator.item');
    }
}
