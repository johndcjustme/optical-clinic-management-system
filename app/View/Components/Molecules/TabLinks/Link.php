<?php

namespace App\View\Components\Molecules\TabLinks;

use Illuminate\View\Component;

class Link extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tabTitle;
    public $wireClick;
    public $subPage;
    
    public function __construct($tabTitle, $wireClick, $subPage)
    {
        $this->tabTitle = $tabTitle;
        $this->wireClick = $wireClick;
        $this->subPage = $subPage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.molecules.tab-links.link');
    }
}
