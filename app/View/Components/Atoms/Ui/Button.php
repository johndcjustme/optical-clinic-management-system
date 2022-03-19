<?php

namespace App\View\Components\Atoms\Ui;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $wireClick;
     public $form;

    public function __construct($wireClick = null, $form = null)
    {
        $this->wireClick = $wireClick;
        $this->form = $form;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.ui.button');
    }
}
