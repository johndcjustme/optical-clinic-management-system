<?php

namespace App\View\Components\Layout\ListsSection;

use Illuminate\View\Component;

class ListItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $itemName;
    public $itemDesc;
    public $avatar;
    public $itemDescIcon;
    public $itemNameIcon;

    public function __construct($itemName = null, $itemDesc = null, $itemDescIcon = null, $avatar = null, $itemNameIcon = null)
    {
        $this->itemName = $itemName;
        $this->itemDesc = $itemDesc;
        $this->avatar = $avatar;
        $this->itemDescIcon = $itemDescIcon;
        $this->itemNameIcon = $itemNameIcon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layout.lists-section.list-item');
    }
}
