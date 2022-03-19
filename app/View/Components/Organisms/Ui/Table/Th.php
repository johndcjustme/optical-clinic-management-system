<?php

namespace App\View\Components\Organisms\Ui\Table;

use Illuminate\View\Component;

class Th extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $asc, $desc, $label, $orderBy;

    public function __construct($asc = null, $desc = null, $label = null, $orderBy = null)
    {
        $this->asc = $asc;
        $this->desc = $desc;
        $this->label = $label;
        $this->orderBy = $orderBy;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.ui.table.th');
    }
}
