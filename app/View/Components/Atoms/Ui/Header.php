<?php

namespace App\View\Components\Atoms\Ui;

use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title, $link, $desc, $icon;

    public function __construct($title = null, $link = null, $desc = null, $icon = null)
    {
        $this->title = $title;
        $this->link = $link;
        $this->desc = $desc;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atoms.ui.header');
    }
}
