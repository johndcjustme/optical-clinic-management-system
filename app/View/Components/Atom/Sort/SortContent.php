<?php

namespace App\View\Components\Atom\Sort;

use Illuminate\View\Component;

class SortContent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $for;
    public $span;
    public $wireModel;
    public $name;
    public $val;

    public function __construct($for, $span, $wireModel, $name, $val)
    {
        $this->for = $for;
        $this->span = $span;
        $this->wireModel = $wireModel;
        $this->name = $name;
        $this->val = $val;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.atom.sort.sort-content');
    }
}
