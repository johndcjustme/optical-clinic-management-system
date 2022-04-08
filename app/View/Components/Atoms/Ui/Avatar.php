<?php

namespace App\View\Components\Atoms\Ui;

use Illuminate\View\Component;

class Avatar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $size;
    
    public function __construct($size = null)
    {
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.ui.avatar');
    }
}
