<?php

namespace App\Http\Livewire\Pages;
use Illuminate\Support\Str;

use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
    
    use WithFileUploads;
    use WithPagination;

    

    public $subPage = 1;

    public $modal = [
        'show'      => false,
        'add'       => false,
        'item'      => false,
        'supplier'  => false,
        'update'    => false,
    ];

    public $item = [
        'id'            => '',
        'image'         => null,
        'name'          => '',
        'desc'          => '',
        'type'          => 'item',
        'size'          => '',
        'qty'           => '',
        'price'         => '',
        'supplier'      => '',
        'buffer'        => '',
        'cost'        => '',
        'has_image'     => '',
    ];

    public $su = [
        'id'            => '',
        'name'          => '',
        'address'       => '',
        'no'            => '',
        'email'         => '',
        'bank'          => '',
        'acc'           => '',
        'branch'        => '',
        'avatar'        => '',
        'has_avatar'    => false,
    ];

    public $delete = [
        'item'      => false,
        'items'     => false,
        'supplier'  => false,
        'suppliers' => false,
    ];


    public 
        $su_sortDirection = 'asc',
        $item_sortDirection = 'asc',
        
        $item_sortColumn = 'item_name',
        $su_sortColumn = 'supplier_name';

    public $searchSupplier, $searchItem = '';

    public $inventoryChangeTable, $onDisplayItemType = 'all';

    public 
        $direction = 'asc',
        $colName = ''; 

    public 
        $selectedItems = [],
        $selectedSuppliers = [];

    public $deletingItem = null;

    public $showDropdown = false;

    public $pageNumber = 10;




    protected $queryString = [
        'searchItem' => ['except' => ''], 
        'onDisplayItemType',
        'subPage' => '1',
    ];

    protected $listeners = ['updatedPhoto'];
     

    protected $rules = [
        'item.name' => 'required',
        'item.image' => 'image|max:1024|nullable',
        'item.type' => 'required',
        'item.price' => 'required|integer',
        'item.qty' => 'required|integer',
    ];
 
    protected $messages = [
        'item.name.required' => 'Required',
        'item.type.required' => 'Required',
        'item.price.required' => 'Required',
        'item.qty.required' => 'Required',
    ];






    
    public function render()
    { 
        switch ($this->subPage) {
            case 1:
                $this->colName = 'item_name';
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
                        'suppliers' => Supplier::all(),
                        'items' => $items,
                    ])
                    ->extends('layouts.app')
                    ->section('content');
                break;

            case 2:
                $this->colName = 'supplier_name';

                $searchSupplier = $this->searchSupplier . '%';
                $suppliers = Supplier::where('supplier_name', 'like', $searchSupplier)
                    ->orWhere('supplier_address', 'like', $searchSupplier)
                    ->orWhere('supplier_contact_no', 'like', $searchSupplier)
                    ->orWhere('supplier_email', 'like', $searchSupplier)
                    ->orderBy('supplier_name', $this->direction)
                    ->get();

                    return view('livewire.pages.page-inventory', 
                    [   
                        'suppliers' => $suppliers,
                    ])
                    ->extends('layouts.app')
                    ->section('content');
                break;

            case 3:
                return view('livewire.pages.page-inventory', ['suppliers' => Supplier::all()])
                    ->extends('layouts.app')
                    ->section('content');
                break;
            default:
        }
    }




   

    public function mount()
    {
        // 
    }

    public function updatedSubPage($pageId)
    {
        $this->resetPage();
        $this->reset(['modal']);
        $this->subPage = $pageId;
    }

    public function updatedPageNumber() { $this->resetPage(); }

    public function updatedSearchItem() { $this->resetPage(); }

    public function resetFields() { $this->reset(['modal', 'su', 'item']); }

    public function itemType($itemType)
    {
        switch ($itemType) {
            case 'le':
                return 'Lense'; break;
            case 'fr':
                return 'Frame'; break;
            case 'ac':
                return 'Accessory'; break;
            default:
        }
    }

    public function itemColor($itemType) 
    {
        switch ($itemType) {
            case 'le':
                return 'blue'; break;
            case 'fr':
                return 'green'; break;
            case 'ac':
                return 'red'; break;
            default:
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
        $this->validate();

        $createItem = [
            'item_name'     => $this->item['name'],
            'item_desc'     => $this->item['desc'],
            'item_type'     => $this->item['type'],
            'item_price'    => $this->item['price'],
            'supplier_id'   => $this->item['supplier'],
            'item_qty'      => $this->item['qty'] + $this->item['buffer'],
            'item_size'     => $this->item['size'],
            'item_buffer'   => $this->item['buffer'],
            'item_cost'     => $this->item['cost'],
            'created_at'    => now(),
            'updated_at'    => now(),
        ];

        if ($this->item['image']) {
            $createItem += ['item_image' => $this->item['image']->hashName()]; 
            $this->item['image']->store('/', 'items');
        }

        Item::create($createItem);

        $this->closeModal();

        $this->dispatchBrowserEvent('toast',[
            'title' => null,
            'class' => 'success',
            'message' => 'Uploaded.',
        ]);
    }

    public function updateItem()
    {
        $foundItemId = Item::findOrFail($this->item['id']);

        $updateItem = [
            'item_name'     => $this->item['name'],
            'item_desc'     => $this->item['desc'],
            'item_type'     => $this->item['type'],
            'item_price'    => $this->item['price'],
            'supplier_id'   => $this->item['supplier'], 
            'item_qty'      => $this->item['qty'] + $this->item['buffer'],
            'item_size'     => $this->item['size'],
            'item_buffer'   => $this->item['buffer'],
            'item_cost'     => $this->item['cost'],
            'updated_at'    => now(),
        ];

        if (!empty($this->item['image']) || ($this->item['image'] != null)) {
            Storage::disk('items')->exists($foundItemId->item_image) ? 
                Storage::disk('items')->delete($foundItemId->item_image) : '';
            
            $updateItem += ['item_image' => $this->item['image']->hashName()];
            $this->item['image']->store('/', 'items');
        }

        $foundItemId->update($updateItem);

        $this->closeModal();
        
        $this->dispatchBrowserEvent('toast', [
            'title' => null,
            'class' => 'success',
            'message' => 'Item updated successfully.',
        ]);
    }

    public function itemQty($itemId)
    {
        $item = Item::find($itemId);
        $qty = $item->item_qty;
        $buffer = $item->item_buffer;

        if ($qty > $buffer) {
            return $qty - $buffer;
        } elseif ($qty < $buffer) {
            return '0';
        }
    }

    public function deletingItem($itemId)
    {
        $this->item['id'] = $itemId;
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

        $deleteItem = Item::find($this->item['id']);

        if (isset($deleteItem->item_image)) {
            Storage::disk('items')->exists($deleteItem->item_image) ?
                Storage::disk('items')->delete($deleteItem->item_image) : '' ;
        }

        $deleteItem->delete();

        $this->confirm_dialog_modal_close();

        $this->dispatchBrowserEvent('toast',[
                'title' => null,
                'class' => 'success',
                'message' => 'Item Deleted successfully.',
        ]);
    }

    public function deleteItems()
    {
        $items = Item::find($this->selectedItems);

        foreach ($items as $item) {
            Storage::disk('items')->exists($item->item_image) ?
                Storage::disk('items')->delete($item->item_image) : '';
        }

        Item::destroy($this->selectedItems);

        $this->selectedItems = [];

        $this->confirm_dialog_modal_close();

        $this->dispatchBrowserEvent('toast', [
            'title' => null,
            'class' => 'success',
            'message' => 'Item Deleted successfully.',
        ]);
    }









    public function addSupplier()
    {

        $this->validate( 
            [
                'su.name' => 'required',
                'su.no' => 'required',
                'su.email' => 'email|nullable',
                'su.avatar' => 'image|max:1024|nullable',
            ],
            [
                'su.name.required' => 'Required',
                'su.no.required' => 'Required',
                'su.email.email' => 'valid Email only',
            ],
        );

        $createSupplier = [
            'supplier_name'         => $this->su['name'],
            'supplier_address'      => $this->su['address'],
            'supplier_contact_no'   => $this->su['no'],
            'supplier_email'        => $this->su['email'],
            'supplier_bank'         => $this->su['bank'],
            'supplier_acc_no'       => $this->su['acc'],
            'supplier_branch'       => $this->su['branch'],
        ];

        if (!empty($this->su['avatar']) || ($this->su['avatar'] != null)) {

            $createSupplier += ['supplier_avatar' => $this->su['avatar']->hashName()];

            $this->su['avatar']->store('/', 'avatars');            
        }
     
        Supplier::create($createSupplier);

        $this->closeModal();
        
        $this->dispatchBrowserEvent('toast', [
            'title' => null,
            'class' => 'success',
            'message' => 'Supplier added successfully.',
        ]);
    }

    public function updateSupplier($supplierId)
    {
        $foundSupplier = Supplier::findOrFail($this->su['id']);

        $updateSupplier = [
            'supplier_name'         => $this->su['name'],
            'supplier_address'      => $this->su['address'],
            'supplier_contact_no'   => $this->su['no'],
            'supplier_email'        => $this->su['email'],
            'supplier_bank'         => $this->su['bank'],
            'supplier_acc_no'       => $this->su['acc'],
            'supplier_branch'       => $this->su['branch'],
        ];

        if (!empty($this->su['avatar']) || ($this->su['avatar'] != null)) {
            Storage::disk('avatars')->exists($foundSupplier->supplier_avatar) ? 
                Storage::disk('avatars')->delete($foundSupplier->supplier_avatar) : '';
            
            $updateSupplier += ['supplier_avatar' => $this->su['avatar']->hashName()];
            $this->su['avatar']->store('/', 'avatars');
        }

        $foundSupplier->update($updateSupplier);

        $this->closeModal();

        $this->dispatchBrowserEvent('toast', [
            'title' => null,
            'class' => 'success',
            'message' => 'Supplier updated successfully.',
        ]);
    }

    public function deletingSupplier($supplierId)
    {
        $this->su['id'] = $supplierId;
        $this->delete['supplier'] = true;
        $this->dispatchBrowserEvent('confirm-dialog'); 
    }

    public function deletingSuppliers()
    {
        $this->delete['suppliers'] = true;

        $this->dispatchBrowserEvent('confirm-dialog'); 
    }

    public function deleteSupplier()
    {

        $supplier = Supplier::find($this->su['id']);

        if (isset($supplier->supplier_avatar)) {
            Storage::disk('avatars')->exists($supplier->supplier_avatar) ?
                Storage::disk('avatars')->delete($supplier->supplier_avatar) : '' ;
        }
        
        $supplier->delete();

        $this->confirm_dialog_modal_close();

        $this->dispatchBrowserEvent('toast', [
            'title' => null,
            'class' => 'success',
            'message' => 'Supplier Deleted successfully.',
        ]);
    }

    public function deleteSuppliers()
    {
        $suppliers = Supplier::find($this->selectedSuppliers);

        foreach ($suppliers as $supplier) {
            Storage::disk('avatars')->exists($supplier->supplier_avatar) ?
                Storage::disk('avatars')->delete($supplier->supplier_avatar) : '';
        }

        Supplier::destroy($this->selectedSuppliers);

        $this->selectedSuppliers = [];

        $this->confirm_dialog_modal_close();

        $this->dispatchBrowserEvent('toast', [
            'title' => null,
            'class' => 'success',
            'message' => 'Suppliers Deleted successfully.',
        ]);
    }








    public function delete()
    {
        $this->delete['item']       ? $this->deleteItem()   : '';
        $this->delete['items']      ? $this->deleteItems()  : '';
        $this->delete['supplier']   ? $this->deleteSupplier() : '';
        $this->delete['suppliers']   ? $this->deleteSuppliers() : '';

        $this->reset(['delete']);
    }

    public function showModal($action, $data, $id)
    {
        $this->resetFields();

        if ($action == 'add') {
            if ($data == 'supplier') { 
                $this->modal['supplier'] = true; }
            elseif ($data == 'item') { 
                $this->modal['item'] = true; }

            $this->modal['add'] = true;
        }

        if ($action == 'update') {
            if ($data == 'item') { 
                $item = Item::findOrFail($id);
                $this->item['id']         = $item->id;
                $this->item['name']       = $item->item_name;
                $this->item['desc']       = $item->item_desc;
                $this->item['type']       = $item->item_type; 
                $this->item['price']      = $item->item_price;
                $this->item['supplier']   = $item->supplier_id;
                $this->item['qty']        = $item->item_qty;
                $this->item['size']       = $item->item_size;
                $this->item['buffer']     = $item->item_buffer;
                $this->item['cost']       = $item->item_cost;

                !empty($item->item_image) || ($item->item_image != null) ? 
                    $this->item['has_image'] = true : '';

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

                !empty($supplier->supplier_avatar) || ($supplier->supplier_avatar != null) ?
                    $this->su['has_avatar'] = true : '';
            
            
                $this->modal['supplier'] = true; 
            }
            $this->modal['update'] = true;
        }
        $this->modal['show'] = true;
        $this->dispatchBrowserEvent('form-modal'); 
    }

    public function closeModal()
    {
        $this->resetFields();
        $this->confirm_dialog_modal_close();
    }
    
    public function confirm_dialog_modal_close() { $this->dispatchBrowserEvent('confirm-dialog-close'); }

    public function storage($disk, $url) 
    {
        if (!empty($url) || ($url != null)) {
            return Storage::disk($disk)->url($url); } 
        else {
            if ($disk == 'avatars') {
                return Storage::disk($disk)->url('default-user-avatar.png'); } 
            elseif ($disk == 'items') { 
                return Storage::disk($disk)->url('default-item-image.jpg'); }
        }
    }
}



