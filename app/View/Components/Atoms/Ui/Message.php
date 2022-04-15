<?php

namespace App\View\Components\Atoms\Ui;

use Illuminate\View\Component;

class Message extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $header;
    public $message;
    public $icon;


    public function __construct($header = null, $message = null, $icon = null)
    {
        $this->header = $header;
        $this->message = $message;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.ui.message');
    }
}
