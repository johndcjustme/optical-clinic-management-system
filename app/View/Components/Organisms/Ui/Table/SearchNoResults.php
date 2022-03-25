<?php

namespace App\View\Components\Organisms\Ui\Table;

use Illuminate\View\Component;

class SearchNoResults extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $message;

    public function __construct($message = null)
    {
        $this->message = $message; 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.ui.table.search-no-results');
    }
}
