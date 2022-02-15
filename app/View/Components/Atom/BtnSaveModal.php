<?php

namespace App\View\Components\Atom;

use Illuminate\View\Component;

class BtnSaveModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $form, $val;

    public function __construct($form, $val)
    {
        $this->form = $form;
        $this->val = $val;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atom.btn-save-modal');
    }
}
