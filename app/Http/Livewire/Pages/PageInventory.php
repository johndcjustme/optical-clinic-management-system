<?php

namespace App\Http\Livewire\Pages;
use Illuminate\Support\Str;


use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tab;
use App\Models\Patient;
use App\Models\Supplier;
use App\Models\Lense;

class PageInventory extends Component
{
    // declarations for modal 

    public $su_session_added = ' Supplier added successfully.';
    public $su_session_updated = 'Supplier updated successfully.';
    

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


    public 
        $su_name,
        $su_contact,
        $su_address,
        $su_bank,
        $su_acc,
        $su_branch,
        $su_email;

    public 
        $sort_direction = 'asc',
        
        $su_defaultOrder = 'supplier_name';
        // $su_orderByDate = 'created_at';

    public $suppliers, $searchSupplier;
        // change table 
    public $inventoryChangeTable;


    public $lenses, $mySupplier;
    
    public function render()
    {
        $this->lenseSupplier = Lense::find(1)->supplier;


        
        $this->lenses = Lense::all();


        $searchSupplier = '%' . $this->searchSupplier . '%';
        $this->suppliers = Supplier::where('supplier_name', 'like', $searchSupplier)
            ->orWhere('supplier_address', 'like', $searchSupplier)
            ->orWhere('supplier_contact_no', 'like', $searchSupplier)
            ->orWhere('supplier_email', 'like', $searchSupplier)
            ->orderBy($this->su_defaultOrder, $this->sort_direction)
            ->get();

        return view('livewire.pages.page-inventory')
            ->extends('layouts.app')
            ->section('content');
    }

    public function moun($mySupplier)
    {
    }


    public function resetField($caseToReset)
    {

        switch ($caseToReset) {
            case 'le':
                dd('reset lens');
                break;

            case 'fr':
                dd('reset frame');
                break;

            case 'ac':
                dd('reset accessory');
                break;

            case 'su':
                $this->reset([
                    'su_name',
                    'su_contact',
                    'su_address',
                    'su_bank',
                    'su_acc',
                    'su_branch',
                    'su_email',
                ]);
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
                $su = Supplier::create([
                    'supplier_name' => $this->su_name,
                    'supplier_contact_no' => $this->su_contact,
                    'supplier_address' => $this->su_address,
                    'supplier_bank' => $this->su_bank,
                    'supplier_acc_no' => $this->su_acc,
                    'supplier_branch' => $this->su_branch,
                    'supplier_email' => $this->su_email,
                ]);
        
                if($su) {
                    $this->inventoryCloseModal();
                    session()->flash('message', $this->su_session_added);
                }
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
                $su = Supplier::find($id);
                $su->update([
                    'supplier_name' => $this->su_name,
                    'supplier_contact_no' => $this->su_contact,
                    'supplier_address' => $this->su_address,
                    'supplier_bank' => $this->su_bank,
                    'supplier_acc_no' => $this->su_acc,
                    'supplier_branch' => $this->su_branch,
                    'supplier_email' => $this->su_email,
                ]);     

                session()->flash('message', $this->su_session_updated);
                break;
        }
        $this->inventoryCloseModal();
    }


    public function deleteInventory($data, $deleteId)
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
                Supplier::find($deleteId)->delete();
                break;
        }
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
   
    
    public function inventoryShowModal($action, $item, $updateId) 
    {
        if ($action === 'isAdd') {
            switch ($item) {
                case 'le':
                    $this->inventoryShowModal = true;
                    $this->isAddItem = true;
                    $this->addLens = true;
                    break;
    
                case 'fr':
                    $this->inventoryShowModal = true;
                    $this->isAddItem = true;
                    $this->addFrame = true;
                    break;
    
                case 'ac':
                    $this->inventoryShowModal = true;
                    $this->isAddItem = true;
                    $this->addAccessory = true;
                    break;
    
                case 'su':
                    $this->resetField('su');
                    $this->inventoryShowModal = true;
                    $this->isAddItem = true;
                    $this->addSupplier = true;
                    break;
            }
        }

        if ($action === 'isUpdate') {
            switch ($item) {
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
                    $this->inventoryShowModal = true;
                    $this->isUpdateItem = true;
                    $this->updateSupplier = true;

                    $su = Supplier::findOrFail($updateId);
                    $this->su_id = $updateId;
                    $this->su_name = Str::title($su->supplier_name);
                    $this->su_contact = Str::title($su->supplier_contact_no);
                    $this->su_address = Str::title($su->supplier_address);
                    $this->su_bank = Str::title($su->supplier_bank);
                    $this->su_acc = Str::title($su->supplier_acc_no);
                    $this->su_branch = Str::title($su->supplier_branch);
                    $this->su_email = Str::title($su->supplier_email);
                    break;
            }
        }
    }

    public function inventoryCloseModal() {
        $this->reset([
            'inventoryShowModal',
                'isAddItem',
                    'addLens',
                    'addFrame',
                    'addAccessory',
                    'addSupplier',

                'isUpdateItem',
                    'updateLens',
                    'updateFrame',
                    'updateAccessory',
                    'updateSupplier',
        ]);
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
}
