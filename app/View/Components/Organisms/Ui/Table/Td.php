<?php

namespace App\View\Components\Organisms\Ui\Table;

use Illuminate\View\Component;

class Td extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $text;
    public $textIcon;
    public $desc;
    public $descIcon;
    public function __construct($text = null, $textIcon = null, $desc = null, $descIcon = null)
    {
        $this->text = $text;
        $this->textIcon = $textIcon;
        $this->desc = $desc;
        $this->descIcon = $descIcon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.ui.table.td');
    }
}
