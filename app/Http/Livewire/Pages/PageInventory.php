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
            $isAddItem = false,
                $addLens = false,
                $addFrame = false,
                $addAccessory = false,
                $addSupplier = false,
            
            $isUpdateItem = false,
                $updateLens = false,
                $updateFrame = false,
                $updateAccessory = false,
                $updateSupplier = false;

    // change table 
    public $inventoryChangeTable;

    public function inventoryOnAddItem($itemType) {
        if($itemType === 'le') {
            dd('lens');
        }
        elseif($itemType === 'fr') {
            dd('frame');
        }
        elseif($itemType === 'ac') {
            dd('accessory');
        }
        elseif($itemType === 'su') {
            dd('supplier');
        }
    }

    public function inventoryChangeTable($value) {
        $activeTab = Tab::find(1);
        $activeTab->inventory_active_tab = $value;
        $activeTab->save();
    }

    public function myTab()
    {
        $userid = 1;
        return Tab::find($userid)->inventory_active_tab;
    }


    public function showModalOnLensUpdate($itemId)
    {
        $this->inventoryShowModal = true;
        $this->isUpdateItem = true;
        $this->updateLens = true;

        // action here 
    }

    public function showModalOnFrameUpdate($itemId)
    {
        $this->inventoryShowModal = true;
        $this->isUpdateItem = true;
        $this->updateFrame = true;

        // action here 
    }

    public function showModalOnAccessoryUpdate($itemId)
    {
        $this->inventoryShowModal = true;
        $this->isUpdateItem = true;
        $this->updateAccessory = true;


        // action here 
    }

    public function showModalOnSupplierUpdate($itemId)
    {
        $this->inventoryShowModal = true;
        $this->isUpdateItem = true;
        $this->updateSupplier = true;

        // action here 
    }
    
    
    public function inventoryShowModal($itemType) 
    {
        if($itemType === 'addLe') {
            $this->inventoryShowModal = true;
            $this->isAddItem = true;
            $this->addLens = true;

            // action here 
        }
        elseif($itemType === 'addFr') {
            $this->inventoryShowModal = true;
            $this->isAddItem = true;
            $this->addFrame = true;

            // action here 
        }
        elseif($itemType === 'addAc') {
            $this->inventoryShowModal = true;
            $this->isAddItem = true;
            $this->addAccessory = true;

            // action here 
        }
        elseif($itemType === 'addSu') {
            $this->inventoryShowModal = true;
            $this->isAddItem = true;
            $this->addSupplier = true;

            // action here 
        }
        elseif($itemType === 'xxx') {
            $this->inventoryShowModal = false;
                $this->isAddItem = false;
                    $this->addLens = false;
                    $this->addFrame = false;
                    $this->addAccessory = false;
                    $this->addSupplier = false;
           
                $this->isUpdateItem = false;
                    $this->updateLens = false;
                    $this->updateFrame = false;
                    $this->updateAccessory = false;
                    $this->updateSupplier = false;
        }
    }


    public function render()
    {
        return view('livewire.pages.page-inventory')
            ->extends('layouts.app')
            ->section('content');
    }
}
