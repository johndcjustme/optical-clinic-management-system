<?php

namespace App\View\Components\Atoms\Ui;

use Illuminate\View\Component;

class Validation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $header;
    public $message;
    public $id;

    public function __construct($header = null, $message = null, $id = null)
    {
        $this->header = $header;
        $this->message = $message;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.ui.validation');
    }
}
