<?php

namespace App\View\Components\Organisms\Ui;

use Illuminate\View\Component;

class Paginator extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wireModel;
    public function __construct($wireModel = null)
    {
        $this->wireModel = $wireModel;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.ui.paginator');
    }
}
