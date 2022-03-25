<?php

namespace App\View\Components\Organisms\Ui\Table;

use Illuminate\View\Component;

class Checkbox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wireModel, $value;

    public function __construct($wireModel = null, $value = null)
    {
        $this->wireModel = $wireModel; 
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.ui.table.checkbox');
    }
}
