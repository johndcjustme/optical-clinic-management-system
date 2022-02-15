<?php

namespace App\Http\Livewire\Pages;
use Illuminate\Support\Str;


use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tab;
use App\Models\Patient;
use App\Models\Lense;
use App\Models\Frame;
use App\Models\Accessory;
use App\Models\Supplier;
use DateTime;

class PageInventory extends Component
{
    // declarations for modal 
    public $le_session_added = 'Lense added successfully.';
    public $le_session_updated = 'Lense updated successfully.';

    public $fr_session_added = 'Frame added successfully.';
    public $fr_session_updated = 'Frame updated successfully.';    

    public $ac_session_added = 'Accessory added successfully.';
    public $ac_session_updated = 'Accessory updated successfully.';  
    
    public $su_session_added = 'Supplier added successfully.';
    public $su_session_updated = 'Supplier updated successfully.';
    

    public
        $inventoryShowModal = false,
            $isAddItem = false,
                $addLense = false,
                $addFrame = false,
                $addAccessory = false,
                $addSupplier = false,
            
            $isUpdateItem = false,
                $updateLense = false,
                $updateFrame = false,
                $updateAccessory = false,
                $updateSupplier = false;


    public 
        $item_type,
        $le_name,
        $le_tint,
        $le_supplier,
        $le_desc,
        $le_qty,
        $le_price,

        $fr_name,
        $fr_size,
        $fr_qty,
        $fr_desc,
        $fr_price,
        $fr_supplier,

        $ac_name,
        $ac_desc,
        $ac_qty,
        $ac_price,
        $ac_supplier,

        $su_name,
        $su_contact,
        $su_address,
        $su_bank,
        $su_acc,
        $su_branch,
        $su_email;

    public 
        $le_sortDirection = 'asc',
        $fr_sortDirection = 'asc',
        $ac_SortDirection = 'asc',
        $su_sortDirection = 'asc';

    public 
        $lenses,
        $searchLense,

        $accessories,
        $searchAccessory,

        $frames,
        $searchFrame,

        $suppliers, 
        $searchSupplier;
        // change table 
    public $inventoryChangeTable;

    public $le_sortColumn = 'lense_name';
    public $su_sortColumn = 'supplier_name';
    // public $sortDirection = 'asc';
    
    public function render()
    {   //lens
        $searchLense = '%' . $this->searchLense . '%';
        $this->lenses = Lense::with('supplier')
            ->where('lense_name', 'like', $searchLense)
            ->orWhere('item_type', 'like', $searchLense)
            ->orWhere('lense_qty', 'like', $searchLense)
            ->orWhere('lense_price', 'like', $searchLense)
            ->orderBy($this->le_sortColumn, $this->le_sortDirection)
            ->get();    


            // switch ($this->le_sortDirection) {
            //     case 'asc':
            //         $this->lenses = $this->lenses->orderBy('lense_name', 'asc')->get();
            //         break;
            //     case 'desc':
            //         $this->lenses = $this->lenses->orderBy('lense_name', 'desc')->get();
            //         break;
            //     case 'last_modified':
            //         $this->lenses = $this->lenses->latest('updated_at')->get();
            //         break;
            //     case 'first_modified':
            //         $this->lenses = $this->lenses->oldest('updated_at')->get();
            //         break;
            // }

        
        //frame
        $searchFrame = '%' . $this->searchFrame . '%';
        $this->frames = Frame::with('supplier')
            ->where('frame_name', 'like', $searchFrame);

            switch ($this->fr_sortDirection) {
                case 'asc':
                    $this->frames = $this->frames->orderBy('frame_name', 'asc')->get();
                    break;
                case 'desc':
                    $this->frames = $this->frames->orderBy('frame_name', 'desc')->get();    
                    break;
                case 'last_modified':
                    $this->frames = $this->frames->latest('updated_at')->get();
                    break;
                case 'first_modified':
                    $this->frames = $this->frames->oldest('updated_at')->get();
                    break;
            }


        //accessory
        $searchAccessory = '%' . $this->searchAccessory . '%';
        $this->accessories = Accessory::with('supplier')
            ->where('accessory_name' , 'like', $searchAccessory);

            switch ($this->ac_SortDirection) {
                case 'asc':
                    $this->accessories = $this->accessories->orderBy('accessory_name', 'asc')->get();
                    break;
                case 'desc':
                    $this->accessories = $this->accessories->orderBy('accessory_name', 'desc')->get();
                    break;
                case 'last_modified':
                    $this->accessories = $this->accessories->latest('updated_at')->get();
                    break;
                case 'first_modified':
                    $this->accessories = $this->accessories->oldest('updated_at')->get();
                    break;
            }

        //supplier
        $searchSupplier = '%' . $this->searchSupplier . '%';
        $this->suppliers = Supplier::where('supplier_name', 'like', $searchSupplier)
            ->orWhere('supplier_address', 'like', $searchSupplier)
            ->orWhere('supplier_contact_no', 'like', $searchSupplier)
            ->orWhere('supplier_email', 'like', $searchSupplier)
            ->orderBy($this->su_sortColumn, $this->su_sortDirection)
            ->get();  

            // switch ($this->ac_SortDirection) {
            //     case 'asc':
            //         $this->suppliers = $this->suppliers->orderBy('supplier_name', 'asc')->get();
            //         break;
            //     case 'desc':
            //         $this->suppliers = $this->suppliers->orderBy('supplier_name', 'desc')->get();
            //         break;
            //     case 'last_modified':
            //         $this->suppliers = $this->suppliers->latest('updated_at')->get();
            //         break;
            //     case 'first_modified':
            //         $this->suppliers = $this->suppliers->oldest('updated_at')->get();
            //         break;
            // }

        return view('livewire.pages.page-inventory')
            ->extends('layouts.app')
            ->section('content');
    }



    public function sortBy($itemType, $columnName)
    {
        switch ($itemType) {
            case 'le':
                if ($this->le_sortColumn == $columnName) {
                    $this->le_sortDirection = $this->le_sortDirection === 'asc' ? 'desc' : 'asc';
                } else {
                    $this->le_sortDirection = 'asc';
                }
                $this->le_sortColumn = $columnName;
                break;

                case 'su':
                    if ($this->su_sortColumn == $columnName) {
                        $this->su_sortDirection = $this->su_sortDirection === 'asc' ? 'desc' : 'asc';
                    } else {
                        $this->su_sortDirection = 'asc';
                    }
                    $this->su_sortColumn = $columnName;

                    break;
            }
    }

    public function sortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }


    public function resetField($caseToReset)
    {

        switch ($caseToReset) {
            case 'le':
                $this->reset([
                    'le_name',
                    'item_type',
                    'le_tint',
                    'le_desc',
                    'le_supplier',
                    'le_qty',
                    'le_price',
                ]);
                break;

            case 'fr':
                $this->reset([
                    'fr_name',
                    'item_type',
                    'fr_desc',
                    'fr_size',
                    'fr_supplier',
                    'fr_qty',
                    'fr_price',
                ]);
                break;

            case 'ac':
                $this->reset([
                    'ac_name',
                    'ac_desc',
                    'ac_qty',
                    'ac_price',
                    'ac_supplier',
                ]);
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
                $validateData = $this->validate([
                    'le_name' => 'required',
                ]); 
                $le = Lense::create([
                    'supplier_id' => $this->le_supplier,
                    'lense_name' => $this->le_name,
                    'item_type' => $this->item_type,
                    'lense_tint' => $this->le_tint,
                    'lense_desc' => $this->le_desc,
                    'lense_qty' => $this->le_qty,
                    'lense_price' => $this->le_price,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ]);
                $this->inventoryCloseModal();
                session()->flash('message', $this->le_session_added);
                $this->resetField('le');
                break;

            case 'fr': 
                $fr = Frame::create([
                    'supplier_id' => $this->fr_supplier,
                    'frame_name' => $this->fr_name,
                    'item_type' => $this->item_type,
                    'frame_desc' => $this->fr_desc,
                    'frame_size' => $this->fr_size,
                    'frame_qty' => $this->fr_qty,
                    'frame_price' => $this->fr_price,
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ]);
                $this->inventoryCloseModal();
                session()->flash('message', $this->fr_session_added);
                $this->resetField('fr');
                break;

            case 'ac': 
                $ac = Accessory::create([
                    'accessory_name' => $this->ac_name,
                    'accessory_desc' => $this->ac_desc,
                    'accessory_qty' => $this->ac_qty,
                    'accessory_price' => $this->ac_price,
                    'supplier_id' => $this->ac_supplier,
                    'item_type' => 'accessory',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime(),
                ]);
                $this->inventoryCloseModal();
                session()->flash('message', $this->ac_session_added);
                $this->resetField('ac');
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
                $this->inventoryCloseModal();
                session()->flash('message', $this->su_session_added);
                $this->resetField('su');
                break;
        }
    }

    public function updateInventory($data, $id) {

        switch ($data) {
            case 'le': // lense
                $le = Lense::findOrFail($id);
                $le->update([
                    'supplier_id' => $this->le_supplier,
                    'lense_name' => $this->le_name,
                    'item_type' => $this->item_type,
                    'lense_tint' => $this->le_tint,
                    'lense_desc' => $this->le_desc,
                    'lense_qty' => $this->le_qty,
                    'lense_price' => $this->le_price,
                    'updated_at' => new DateTime(),
                ]);
                session()->flash('message', $this->le_session_updated);
                $this->resetField('le');
                break;
                
            case 'fr': // frame
                $fr = Frame::find($id);
                $fr->update([
                    'supplier_id' => $this->fr_supplier,
                    'frame_name' => $this->fr_name,
                    'item_type' => $this->item_type,
                    'frame_desc' => $this->fr_desc,
                    'frame_size' => $this->fr_size,
                    'frame_qty' => $this->fr_qty,
                    'frame_price' => $this->fr_price,
                    'updated_at' => new DateTime(),
                ]);
                session()->flash('message', $this->fr_session_updated);
                $this->resetField('fr');
                break;

            case 'ac': // accessory
                $ac = Accessory::find($id);
                $ac->update([
                    'supplier_id' => $this->ac_supplier,
                   'accessory_name' => $this->ac_name,
                   'accessory_desc' => $this->ac_desc,
                   'accessory_qty' => $this->ac_qty,
                   'accessory_price' => $this->ac_price,
                   'updated_at' => new DateTime(),
                ]);
                session()->flash('message', $this->ac_session_updated);
                $this->resetField('ac');
                break;

            case 'su': // suppliers
                $su = Supplier::find($id);
                $su->update([
                    'supplier_name' => $this->su_name,
                    'supplier_contact_no' => $this->su_contact,
                    'supplier_address' => $this->su_address,
                    'supplier_bank' => $this->su_bank,
                    'supplier_acc_no' => $this->su_acc,
                    'supplier_branch' => $this->su_branch,
                    'supplier_email' => $this->su_email,
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);     
                session()->flash('message', $this->su_session_updated);
                $this->resetField('su');
                break;
        }
        $this->inventoryCloseModal();
    }


    public function deleteInventory($data, $deleteId)
    {
        switch($data) {
            case 'le':
                Lense::find($deleteId)->delete();
                break;

            case 'fr':
                Frame::find($deleteId)->delete();
                break;

            case 'ac':
                Accessory::find($deleteId)->delete();
                break;

            case 'su':
                Supplier::find($deleteId)->delete();
                break;
        }
    }
   
    
    public function inventoryShowModal($action, $data, $updateId) 
    {
        if ($action === 'isAdd') {
            switch ($data) {
                case 'le':
                    $this->resetField('le');
                    $this->inventoryShowModal = true;
                    $this->isAddItem = true;
                    $this->addLense = true;
                    break;
    
                case 'fr':
                    $this->resetField('fr');
                    $this->inventoryShowModal = true;
                    $this->isAddItem = true;
                    $this->addFrame = true;
                    break;
    
                case 'ac':
                    $this->resetField('ac');
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
            switch ($data) {
                case 'le':
                    $this->inventoryShowModal = true;
                    $this->isUpdateItem = true;
                    $this->updateLense = true;

                    $le = Lense::findOrFail($updateId);
                    $this->le_id = $updateId;
                    $this->le_name = Str::title($le->lense_name);
                    $this->item_type = Str::title($le->item_type);
                    $this->le_tint = Str::title($le->lense_tint);
                    $this->le_desc = Str::title($le->lense_desc);
                    $this->le_qty = Str::title($le->lense_qty);
                    $this->le_price = Str::title($le->lense_price);
                    $le->supplier_id == null ?
                        $this->le_supplier = '' :
                        $this->le_supplier = Str::title($le->supplier_id);
                    break;
    
                case 'fr':
                    $this->inventoryShowModal = true;
                    $this->isUpdateItem = true;
                    $this->updateFrame = true;

                    $fr = Frame::findOrFail($updateId);
                    $this->fr_id = $updateId;
                    $this->fr_name = Str::title($fr->frame_name);
                    $this->item_type = Str::title($fr->item_type);
                    $this->fr_size = Str::title($fr->frame_size);
                    $this->fr_desc = Str::title($fr->frame_desc);
                    $this->fr_qty = Str::title($fr->frame_qty);
                    $this->fr_price = Str::title($fr->frame_price);
                    $fr->supplier_id == null ?
                        $this->fr_supplier = '' :
                        $this->fr_supplier = Str::title($fr->supplier_id);
                    break;
    
                case 'ac':
                    $this->inventoryShowModal = true;
                    $this->isUpdateItem = true;
                    $this->updateAccessory = true;

                    $ac = Accessory::findOrFail($updateId);
                    $this->ac_id = $updateId;
                    $this->ac_name = Str::title($ac->accessory_name);
                    $this->ac_desc = Str::title($ac->accessory_desc);
                    $this->ac_qty = Str::title($ac->accessory_qty);
                    $this->ac_price = Str::title($ac->accessory_price);
                    $ac->supplier_id == null ? 
                        $this->ac_supplier = '' : 
                        $this->ac_supplier = Str::title($ac->supplier_id);
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
        $this->resetField('le');
        $this->resetField('fr');
        $this->resetField('ac');
        $this->resetField('su');
        $this->reset([
            'inventoryShowModal',
                'isAddItem',
                    'addLense',
                    'addFrame',
                    'addAccessory',
                    'addSupplier',

                'isUpdateItem',
                    'updateLense',
                    'updateFrame',
                    'updateAccessory',
                    'updateSupplier',
        ]);
    }

    public function inventoryChangeTable($value) 
    {
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
