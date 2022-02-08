<?php

namespace App\Http\Livewire\Pages;
use Illuminate\Support\Str;


use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tab;
use App\Models\Patient;
use App\Models\Supplier;

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

    public 
        $su_name,
        $su_contact,
        $su_address,
        $su_bank,
        $su_acc,
        $su_branch;

    public $suppliers, $searchSupplier;

    public function render()
    {

        $searchSupplier = '%' . $this->searchSupplier . '%';
        $this->suppliers = Supplier::where('supplier_name', 'like', $searchSupplier)
            ->orWhere('supplier_address', 'like', $searchSupplier)
            ->orWhere('supplier_bank', 'like', $searchSupplier)
            ->orWhere('supplier_branch', 'like', $searchSupplier)
            ->orWhere('supplier_acc_no', 'like', $searchSupplier)
            ->orWhere('supplier_contact_no', 'like', $searchSupplier)
            ->get();

        return view('livewire.pages.page-inventory')
            ->extends('layouts.app')
            ->section('content');
    }



    public function resetSu()
    {
        $this->su_name = '';
        $this->su_contact = '';
        $this->su_address = '';
        $this->su_bank = '';
        $this->su_acc = '';
        $this->su_branch = '';
    }

    public function addSu() {

        $su = Supplier::create([
            'supplier_name' => $this->su_name,
            'supplier_contact_no' => $this->su_contact,
            'supplier_address' => $this->su_address,
            'supplier_bank' => $this->su_bank,
            'supplier_acc_no' => $this->su_acc,
            'supplier_branch' => $this->su_branch,
        ]);

        if($su) {
            $this->inventoryShowModal('xxx');
            session()->flash('message','Supplier Successfully Added.');
        }
    }

    public function deleteInventory($data, $id)
    {
        switch($data) {
            case 'le':
                dd('lens');
                break;

            case 'fr':
                dd('frame');
                break;

            case 'ac':
                dd('accessory');
                break;

            case 'su':
                Supplier::find($id)->delete();
                break;
        }
    }

    public function addInventory($itemType) 
    {
        switch($itemType) {
            case 'le': 
                dd('lens');
                break;

            case 'fr': 
                dd('frame');
                break;

            case 'ac': 
                dd('accessory');
                break;

            case 'su': 
                $this->addSU();
                break;
        }
    }

    public function updateInventory($data, $id) {

        switch ($data) {
            case 'le': 
                dd('update lens');
                break;
                
            case 'fr': 
                dd('update frame');
                break;

            case 'ac': 
                dd('update accessory');
                break;

            case 'su': 
                $id = $this->su_id;
    
                $su = Supplier::find($id);
                $su->update([
                    'supplier_name' => $this->su_name,
                    'supplier_contact_no' => $this->su_contact,
                    'supplier_address' => $this->su_address,
                    'supplier_bank' => $this->su_bank,
                    'supplier_acc_no' => $this->su_acc,
                    'supplier_branch' => $this->su_branch,
                ]);     

                session()->flash('message','Supplier updated succesfully.');

                break;
        }
        $this->inventoryShowModal('xxx');
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


    public function showModalOnLensUpdate($id)
    {
        $this->inventoryShowModal = true;
        $this->isUpdateItem = true;
        $this->updateLens = true;
    }

    public function showModalOnFrameUpdate($id)
    {
        $this->inventoryShowModal = true;
        $this->isUpdateItem = true;
        $this->updateFrame = true;

        // action here 
    }

    public function showModalOnAccessoryUpdate($id)
    {
        $this->inventoryShowModal = true;
        $this->isUpdateItem = true;
        $this->updateAccessory = true;


        // action here 
    }

    public function showModalOnSupplierUpdate($id)
    {
        $this->inventoryShowModal = true;
        $this->isUpdateItem = true;
        $this->updateSupplier = true;

        $su = Supplier::findOrFail($id);
            $this->su_id = $id;
            $this->su_name = Str::title($su->supplier_name);
            $this->su_contact = Str::title($su->supplier_contact_no);
            $this->su_address = Str::title($su->supplier_address);
            $this->su_bank = Str::title($su->supplier_bank);
            $this->su_acc = Str::title($su->supplier_acc_no);
            $this->su_branch = Str::title($su->supplier_branch);
    }

    
    
    public function inventoryShowModal($itemType) 
    {
        if($itemType === 'addLe') {
            $this->inventoryShowModal = true;
            $this->isAddItem = true;
            $this->addLens = true;
        }
        elseif($itemType === 'addFr') {
            $this->inventoryShowModal = true;
            $this->isAddItem = true;
            $this->addFrame = true;
        }
        elseif($itemType === 'addAc') {
            $this->inventoryShowModal = true;
            $this->isAddItem = true;
            $this->addAccessory = true;
        }
        elseif($itemType === 'addSu') {
            $this->resetSu();
            $this->inventoryShowModal = true;
            $this->isAddItem = true;
            $this->addSupplier = true;
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
}
