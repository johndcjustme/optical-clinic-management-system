<?php

namespace App\Http\Livewire\Pages;
use Illuminate\Support\Str;


use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tab;
use App\Models\Patient;
// use App\Models\Lense;
// use App\Models\Frame;
// use App\Models\Accessory;
use App\Models\Supplier;
use App\Models\Item;
use Livewire\WithPagination;

use DateTime;

class PageInventory extends Component
{
    
    use WithPagination;

    // declarations for modal 
    public $le_session_added = 'Lense added successfully.';
    public $le_session_updated = 'Lense updated successfully.';

    public $fr_session_added = 'Frame added successfully.';
    public $fr_session_updated = 'Frame updated successfully.';    

    public $ac_session_added = 'Accessory added successfully.';
    public $ac_session_updated = 'Accessory updated successfully.';  
    
    public $su_session_added = 'Supplier added successfully.';
    public $su_session_updated = 'Supplier updated successfully.';
    
    public $subPage = 1;

    public $modal = [
        'show' => false,
        'add' => false,
        'item' => false,
        'supplier' => false,
        'update' => false,
    ];

    public $item = [
        'id' => '',
        'name' => '',
        'desc' => '',
        'type' => 'item',
        'size' => '',
        'qty' => '',
        'price' => '',
        'supplier' => '',
    ];

    public $su = [
        'id'        => '',
        'name'      => '',
        'address'   => '',
        'no'        => '',
        'email'     => '',
        'bank'      => '',
        'acc'       => '',
        'branck'       => '',
    ];

    public $delete = [
        'item' => false,
        'items' => false,
        'supplier' => false,
    ];


    public 
        $le_sortDirection = 'asc',
        $fr_sortDirection = 'asc',
        $ac_sortDirection = 'asc',
        $su_sortDirection = 'asc',
        $item_sortDirection = 'asc',
        
        $item_sortColumn = 'item_name',
        $le_sortColumn = 'lense_name',
        $fr_sortColumn = 'frame_name',
        $ac_sortColumn = 'accessory_name',
        $su_sortColumn = 'supplier_name';

    public 
        $searchSupplier,
        $searchItem = '',

        $su_paginateVal = 5;
        // change table 
    public $inventoryChangeTable, $onDisplayItemType = 'all';


    public $colName='item_name', $direction = 'asc';


    public $selectedItems = [];

    public $deletingItem = null;


    public $showDropdown = false;

    public $pageNumber = 10;


    protected $queryString = ['searchItem' => ['except' => '']];
 
    public function render()
    {  

        //supplier    
        $searchSupplier = $this->searchSupplier . '%';
        $suppliers = Supplier::where('supplier_name', 'like', $searchSupplier)
            ->orWhere('supplier_address', 'like', $searchSupplier)
            ->orWhere('supplier_contact_no', 'like', $searchSupplier)
            ->orWhere('supplier_email', 'like', $searchSupplier)
            ->orderBy($this->su_sortColumn, $this->su_sortDirection)
            ->get();



        $searchItem = $this->searchItem . '%';
        if ($this->onDisplayItemType == 'all') {
            $items = Item::with('supplier')
                ->where('item_name', 'like', $searchItem)
                ->orderBy($this->colName, $this->direction)
                ->paginate($this->pageNumber);
        } else {
            $items = Item::with('supplier')
                ->where('item_name', 'like', $searchItem)
                ->where('item_type', $this->onDisplayItemType)
                ->orderBy($this->colName, $this->direction)
                ->paginate($this->pageNumber);        
        }
        


        return view('livewire.pages.page-inventory', 
            [   
                'suppliers' => $suppliers,
                'items' => $items,
            ])
            ->extends('layouts.app')
            ->section('content');
    }


   

    public function mount(Request $req)
    {
        if ($req->subPage == 1) {
            $this->subPage=1;
        }
        elseif ($req->subPage == 2) {
            $this->subPage=2;
        }
    }

    public function updatedSearchItem()
    {
        $this->resetPage();
    }


    // public function updatingSearch()
    // {
    //     if (!empty($this->searchItem)) {
    //         $this->resetPage();
    //     }
    // }

    // public function sortBy($itemType, $columnName)
    // {
    //     $this->resetPage();

    //     if ($itemType === $itemType) {
    //         $sortColumn = $itemType . '_sortColumn';
    //         $sortDirection = $itemType . '_sortDirection';
    //         $this->$sortColumn == $columnName ? $this->$sortDirection = $this->$sortDirection === 'asc' ? 'desc' : 'asc' : '';
    //         $this->$sortColumn = $columnName;
    //     }
    // }

    public function itemType($itemType)
    {
        switch ($itemType) {
            case 'le':
                return 'Lense';
                break;
            case 'fr':
                return 'Frame';
                break;
            case 'ac':
                return 'Accessory';
                break;
        }
    }

    public function itemColor($itemType) 
    {
        switch ($itemType) {
            case 'le':
                return 'blue';
                break;
            case 'fr':
                return 'green';
                break;
            case 'ac':
                return 'red';
                break;
        }
    }

    public function orderBy($colName, $direction)
    {
        $this->resetPage();

        $this->colName = $colName;
        $this->direction = $direction;
    }


    public function addItem() 
    {
        Item::create([
            'item_name'     => $this->item['name'],
            'item_desc'     => $this->item['desc'],
            'item_type'     => $this->item['type'],
            'item_price'    => $this->item['price'],
            'supplier_id'   => $this->item['supplier'],
            'item_qty'      => $this->item['qty'],
            'item_size'     => $this->item['size'],
        ]);
        $this->closeModal();
        $this->resetPage();
        // session()->flash('message', 'added successfully.');
        $this->dispatchBrowserEvent('toast',
            [
                'title' => null,
                'class' => 'success',
                'message' => 'Item added successfully.',
            ]
        );
    }

    public function updateItem($itemId)
    {
        Item::findOrFail($itemId)
            ->update([
                'item_name'     => $this->item['name'],
                'item_desc'     => $this->item['desc'],
                'item_type'     => $this->item['type'],
                'item_price'    => $this->item['price'],
                'supplier_id'   => $this->item['supplier'],
                'item_qty'      => $this->item['qty'],
                'item_size'     => $this->item['size'],
            ]);
        $this->closeModal();
        $this->dispatchBrowserEvent('toast',
            [
                'title' => null,
                'class' => 'success',
                'message' => 'Item updated successfully.',
            ]
        );
        // session()->flash('message', 'updated successfully.');
    }

    public function deletingItem($itemId)
    {
        $this->deletingItem = $itemId;
        $this->delete['item'] = true;
        $this->dispatchBrowserEvent('confirm-dialog'); 
    }

    public function deletingItems()
    {
        $this->delete['items'] = true;
        $this->dispatchBrowserEvent('confirm-dialog'); 
    }

    public function deleteItem()
    {
        Item::destroy($this->deletingItem);
        $this->confirm_dialog_modal_close();
        // session()->flash('message', 'Deleted successfully.');
        $this->dispatchBrowserEvent('toast',
            [
                'title' => null,
                'class' => 'success',
                'message' => 'Item Deleted successfully.',
            ]
        );
    }

    public function deleteItems()
    {
        Item::destroy($this->selectedItems);
        $this->selectedItems = [];
        $this->confirm_dialog_modal_close();
        // session()->flash('message', 'Deleted successfully.');
        $this->dispatchBrowserEvent('toast',
            [
                'title' => null,
                'class' => 'success',
                'message' => 'Item Deleted successfully.',
            ]
        );
    }

    public function deletingSupplier($supplierId)
    {
        $this->delete['supplier'] = true;
        $this->dispatchBrowserEvent('confirm-dialog'); 
    }

    public function delete()
    {
        $this->delete['item']       ? $this->deleteItem()   : '';
        $this->delete['items']      ? $this->deleteItems()  : '';
        $this->delete['supplier']   ? dd('delete supplier') : '';

        $this->reset(['delete']);
    }

    public function addSupplier()
    {

        Supplier::create([
            'supplier_name'         => $this->su['name'],
            'supplier_address'      => $this->su['address'],
            'supplier_contact_no'   => $this->su['no'],
            'supplier_email'        => $this->su['email'],
            'supplier_bank'         => $this->su['bank'],
            'supplier_acc_no'       => $this->su['acc'],
            'supplier_branch'       => $this->su['branch'],
        ]);
        $this->closeModal();
        // session()->flash('message', 'added successfully.');
        $this->dispatchBrowserEvent('toast',
            [
                'title' => null,
                'class' => 'success',
                'message' => 'Supplier added successfully.',
            ]
        );
    }

    public function updateSupplier($supplierId)
    {
        Supplier::findOrFail($supplierId)
            ->update([
                'supplier_name'         => $this->su['name'],
                'supplier_address'      => $this->su['address'],
                'supplier_contact_no'   => $this->su['no'],
                'supplier_email'        => $this->su['email'],
                'supplier_bank'         => $this->su['bank'],
                'supplier_acc_no'       => $this->su['acc'],
                'supplier_branch'       => $this->su['branch'],
            ]);
            $this->closeModal();
            // session()->flash('message', 'updated successfully.');
            $this->dispatchBrowserEvent('toast',
                [
                    'title' => null,
                    'class' => 'success',
                    'message' => 'Supplier updated successfully.',
                ]
            );
    }


    public function showModal($action, $data, $id)
    {
        $this->reset(['modal', 'su', 'item']);

        if ($action == 'add') {
            $this->reset(['modal', 'su', 'item']);
            if ($data == 'supplier')        { $this->modal['supplier'] = true; }
            elseif ($data == 'item')        { $this->modal['item'] = true; }
            $this->modal['add'] = true;
        }
        elseif ($action == 'update') {
            if ($data == 'item') { 
                $item = Item::findOrFail($id);
                $this->item['id']           = $item->id;
                $this->item['name']         = $item->item_name;
                $this->item['desc']         = $item->item_desc;
                $this->item['type']         = $item->item_type; 
                $this->item['price']        = $item->item_price;
                $this->item['supplier']     = $item->supplier_id;
                $this->item['qty']          = $item->item_qty;
                $this->item['size']         = $item->item_size;
            
                $this->modal['item'] = true; 
            }
            elseif ($data == 'supplier') { 
                $supplier = Supplier::findOrFail($id);
                $this->su['id']         = $supplier->id;
                $this->su['name']       = $supplier->supplier_name;
                $this->su['address']    = $supplier->supplier_address;
                $this->su['no']         = $supplier->supplier_contact_no;
                $this->su['email']      = $supplier->supplier_email;
                $this->su['bank']       = $supplier->supplier_bank;
                $this->su['acc']        = $supplier->supplier_acc_no;
                $this->su['branch']     = $supplier->supplier_branch;

                $this->modal['supplier'] = true; 
            }
            $this->modal['update'] = true;
        }
        $this->dispatchBrowserEvent('form-modal'); 
    }

    public function closeModal()
    {
        // $this->dispatchBrowserEvent('confirm-dialog-close'); 
        // $this->reset(['modal', 'su', 'item']);

        $this->confirm_dialog_modal_close();
    }


    // public function inventoryChangeTable($value) 
    // {
    //     $activeTab = Tab::find(1);
    //     $activeTab->inventory_active_tab = $value;
    //     $activeTab->save();
    // }

    // public function myTab()
    // {
    //     $userid = 1;
    //     return Tab::find($userid)->inventory_active_tab;
    // }
    
    public function confirm_dialog_modal_close() 
    {
        $this->dispatchBrowserEvent('confirm-dialog-close'); 
    }

    public function setPageNumber($pageNumber)
    {
        $this->resetPage();
        return $pageNumber;
    }
}



