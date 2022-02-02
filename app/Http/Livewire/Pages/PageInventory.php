<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tab;
use App\Models\Patient;

class PageInventory extends Component
{
    // declarations for modal 
    public
        $inventoryShowModal = false,
        $addLens = false,
        $addFrame = false,
        $addAccessory = false,
        $addSupplier = false;

    // change table 
    public $inventoryChangeTable;
    // public $myTable;

    public function inventoryChangeTable($value) {
        $tab = $value;
        $activeTab = Tab::find(1);
        $activeTab->inventory_active_tab = $value;
        $activeTab->save();
    }

    public function myTable()
    {
        return Tab::find(1)->inventory_active_tab;
    }


    
    public function inventoryShowModal($itemType) 
    {

        if($itemType === 'addLens') {
            $this->inventoryShowModal = true;
            $this->addLens = true;
        }
        elseif($itemType === 'addFrame') {
            $this->inventoryShowModal = true;
            $this->addFrame = true;
        }
        elseif($itemType === 'addAccessory') {
            $this->inventoryShowModal = true;
            $this->addAccessory = true;
        }
        elseif($itemType === 'addSupplier') {
            $this->inventoryShowModal = true;
            $this->addSupplier = true;
        }
        elseif($itemType === 'xxx') {
            $this->inventoryShowModal = false;
            $this->addLens = false;
            $this->addFrame = false;
            $this->addAccessory = false;
            $this->addSupplier = false;
        }
    }

    public function render()
    {
        return view('livewire.pages.page-inventory')
            ->extends('layouts.app')
            ->section('content');
    }
}
