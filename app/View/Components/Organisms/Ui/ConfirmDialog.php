<?php

namespace App\View\Components\Organisms\Ui;

use Illuminate\View\Component;

class ConfirmDialog extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $wireConfirm, $wireCancel, $content;

    public function __construct($wireConfirm = null, $wireCancel = null, $content = null)
    {
        $this->wireCancel = $wireCancel;
        $this->wireConfirm = $wireConfirm;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.organisms.ui.confirm-dialog');
    }
}
