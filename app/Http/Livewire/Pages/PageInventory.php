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
use App\Models\In_out_of_item as In_item;
// use App\Models\Lense;
// use App\Models\Frame;
// use App\Models\Accessory;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Item;
use Livewire\WithPagination;

use DateTime;

class PageInventory extends Component
{
    
    use WithFileUploads;
    use WithPagination;

    

    public $subPage = 1;


    public $sort = 'asc', $status = 'all';

    public $showInOut = false;

    public $filterLowStocks = false;

    public $countLowStocks;

    public $modal = [
        'show'           => false,
        'add'            => false,
        'item'           => false,
        'supplier'       => false,
        'update'         => false,
        'inItem'         => false,
        'edit_in_inItem' => false,
        'category'       => false,
        'displayItem'    => false,
        'show_image'     => false,
    ];

    public $item = [
        'id'            => '',
        'preview'       => '',
        'image'         => '',
        'name'          => '',
        'cat'           => '',
        'desc'          => '',
        'type'          => '',
        'size'          => '',
        'qty'           => '',
        'price'         => '',
        'supplier'      => '',
        'buffer'        => '',
        'cost'          => '',
        'has_image'     => '',
        'in'            => '',
        'on_hand'       => '',
    ];

    // public $su = [
    //     'id'            => '',
    //     'name'          => '',
    //     'address'       => '',
    //     'no'            => '',
    //     'email'         => '',
    //     'bank'          => '',
    //     'acc'           => '',
    //     'branch'        => '',
    //     'avatar'        => '',
    //     'has_avatar'    => false,
    // ];

    public $cat = [
        'id'    => '',
        'name'  => '',
        'desc'  => '',
    ];

    public $delete = [
        'item'      => false,
        'items'     => false,
        'supplier'  => false,
        'suppliers' => false,
        'category'  => false,
    ];

    public 
        // $su_sortDirection = 'asc',
        $item_sortDirection = 'asc',
        
        $item_sortColumn = 'item_name';
        // $su_sortColumn = 'supplier_name';

    public 
        $searchItem = '';
        // $searchSupplier, 

    public $inventoryChangeTable, $onDisplayItemType = 'all';

    public 
        $direction = 'asc',
        $colName = ''; 

    public 
        $selectedItems = [];
        // $selectedSuppliers = [];

    public $deletingItem = null;

    public $showDropdown = false;

    public $pageNumber = 10;



    protected $queryString = [
        'searchItem' => ['except' => ''],
        'onDisplayItemType',
        'subPage' => '1',
        'status',
        'filterLowStocks' => ['except' => false]
    ];

    protected $listeners = ['updatedPhoto'];
     

    protected $rules = [
        'item.name' => 'required',
        'item.preview' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
        'item.supplier' => 'nullable',
        'item.cat' => 'nullable'
        // 'item.price' => 'required|integer',
        // 'item.qty' => 'required|integer',
    ];
 
    protected $messages = [
        'item.name.required' => 'Required',
        // 'item.type.required' => 'Required',
        // 'item.price.required' => 'Required',
        // 'item.qty.required' => 'Required',
    ];
    






    
    public function render()
    { 
        $data = [];
        $items;

        switch ($this->subPage) {
            case 1:
                $countLowStocksArray = [];
                $this->colName = 'item_name';
                $searchItem = $this->searchItem . '%';
                $suppliers = Supplier::select(['supplier_address', 'supplier_branch'])->get();
                $items = Item::select([
                    'id',
                    'category_id',
                    'item_image',
                    'item_name',
                    'item_desc',
                    'item_qty',
                    'item_size',
                    'item_type',
                    'item_price',
                    'item_buffer',
                    'item_cost',
                    'supplier_id',
                ])->with(['supplier','category']);

                $this->onDisplayItemType == 'all'
                    ? $items->where('item_name', 'like', $searchItem)
                    : $items->where('item_name', 'like', $searchItem)->where('category_id', $this->onDisplayItemType);

                $this->filterLowStocks
                    ? $items->whereColumn('item_qty', '<=', 'item_buffer') 
                    : '';

                $data = [   
                    'suppliers' => $suppliers,
                    'items' => $items->orderBy($this->colName, $this->direction)->paginate($this->pageNumber),
                ];

                foreach ($items->whereColumn('item_qty', '<=', 'item_buffer')->get() as $countLowStock) {
                    $countLowStocksArray[] = $countLowStock; }

                $this->countLowStocks = count($countLowStocksArray);
                break;

            case 2:
                // $this->colName = 'supplier_name';

                // $searchSupplier = $this->searchSupplier . '%';
                // $suppliers = Supplier::where('supplier_name', 'like', $searchSupplier)
                //     ->orWhere('supplier_address', 'like', $searchSupplier)
                //     ->orWhere('supplier_contact_no', 'like', $searchSupplier)
                //     ->orWhere('supplier_email', 'like', $searchSupplier)
                //     ->orderBy('supplier_name', $this->direction)
                //     ->get();

                //     return view('livewire.pages.page-inventory', 
                //     [   
                //         'suppliers' => $suppliers,
                //     ])
                //     ->extends('layouts.app')
                //     ->section('content');
                // break;

            case 3:

                $items = Item::all();

                $data = [
                    'show_in_out_of_item' => In_item::select(['created_at', 'status', 'qty'])->where('item_id', $this->item['id'])->orderBy('id', $this->sort)->paginate($this->pageNumber),
                    'item_in_out' => Item::select(['id', 'item_name', 'item_desc', 'item_qty', 'created_at',])->with(['latestInOut'])->paginate($this->pageNumber),
                    'items' => $items,
                ];
                break;
            case 4:
                $data = [];
                break;
            default:
        }

        $data += [
            'categories' => Category::all(),
        ];

        return view('livewire.pages.page-inventory', $data)
            ->extends('layouts.app')
            ->section('content');
    }




   

    public function mount()
    {
        // 
    }

    public function showInOut($itemId)
    {
        $item = Item::select(['item_name', 'item_desc'])->find($itemId);
        
        $this->item['id'] = $itemId;
        $this->showInOut = true;
        $this->item['name'] = $item->item_name;
        $this->item['desc'] = $item->item_desc;
    }


    public function updatedOnDisplayItemType()
    {
        $this->subPage = 1;
    }


    public function updatedSubPage($pageId)
    {
        $this->resetPage();
        $this->reset(['modal']);
        $this->subPage = $pageId;
    }

    public function updatedPageNumber() { $this->resetPage(); }

    public function updatedSearchItem() { $this->resetPage(); }

    public function resetFields() { $this->reset(['modal', 'item', 'cat']); }

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
            case 'le': return 'blue'; break;
            case 'fr': return 'green'; break;
            case 'ac': return 'red'; break;
            default:
        }
    }

    public function orderBy($colName, $direction)
    {
        $this->resetPage();

        $this->reset(['colName', 'direction']);

        $this->colName = $colName;
        $this->direction = $direction;
    }




    // public function addCategory()
    // {
    //     $category = Category::create([
    //         'name' => $this->cat['name'],
    //         'desc' => $this->cat['desc'],
    //     ]);

    //     $category 
    //         ? $this->dispatchBrowserEvent('toast',[
    //             'title' => null,
    //             'class' => 'success',
    //             'message' => 'Category successfully added.',
    //         ])
    //         : $this->dispatchBrowserEvent('toast',[
    //             'title' => null,
    //             'class' => 'error',
    //             'message' => 'An error has occured.',
    //         ]);
        
    //     $this->closeModal();
    // }

    public function updateOrCreateCategory()
    {
        $this->validate(
            [
                'cat.name' => 'required',
            ],
            [
                'cat.name.required' => 'Required',
            ]
        );

        if (!empty($this->cat['id'])) {
            $category = Category::findOrFail($this->cat['id'])
            ->update([
                'name' => $this->cat['name'],
                'desc' => $this->cat['desc'],
            ]);

            $category 
                ? $this->dispatchBrowserEvent('toast',[
                    'title' => null,
                    'class' => 'success',
                    'message' => 'Category successfully updated.',
                ])
                : $this->dispatchBrowserEvent('toast',[
                    'title' => null,
                    'class' => 'error',
                    'message' => 'An error has occured.',
                ]);

        } else {
            $category = Category::create([
                    'name' => $this->cat['name'],
                    'desc' => $this->cat['desc'],
                    'cname' => 'black',
                    'cvalue' => '#000000',
                ]);
        
            $category 
                ? $this->dispatchBrowserEvent('toast',[
                    'title' => null,
                    'class' => 'success',
                    'message' => 'Category successfully added.',
                ])
                : $this->dispatchBrowserEvent('toast',[
                    'title' => null,
                    'class' => 'error',
                    'message' => 'An error has occured.',
                ]);
            
        }
        $this->closeModal();
    }




    public function updateOrCreateItem()
    {
        !empty($this->item['id'])
            ? $this->updateItem()
            : $this->addItem();
    }


    public function addItem() 
    {    
        $this->validate();

        $createItem = $this->setItem();

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

    

    public function updateItemFromInItem()
    {
        $item = Item::findOrFail($this->item['id']);

        $item->update($this->setItem());

        $this->modal['edit_in_inItem'] = false;

        session()->flash('hey', 'Item Successfully updated.');
        // $this->dispatchBrowserEvent('toast', [
        //     'title' => null,
        //     'class' => 'success',
        //     'message' => 'Item updated successfully.',
        // ]);
    }


    public function updateItem()
    {
        $item = Item::findOrFail($this->item['id']);
       
        $updateItem = $this->setItem();

        if (!empty($this->item['preview']) || ($this->item['preview'] != null)) {
            Storage::disk('items')->exists($item->item_image) ? 
                Storage::disk('items')->delete($item->item_image) : '';
            
            $updateItem += ['item_image' => $this->item['preview']->hashName()];
            $this->item['preview']->store('/', 'items');
        }

        $item->update($updateItem);

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


    public function deletingCategory($catId, $catName)
    {
        $this->delete['category'] = true;
        $this->cat['id'] = $catId;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Confirm',
            'content' => 'Are you sure you want to delete this category? "' . $catName . '"'
        ]);
    }

    public function deleteCategory() 
    {
        Category::destroy($this->cat['id']);
        $this->reset(['cat']);
        $this->dispatchBrowserEvent('confirm-dialog-close');
        $this->dispatchBrowserEvent('toast', [
            'title' => 'Success',
            'class' => 'success',
            'message' => 'Category has been deleted successfully.',
        ]);
    }

    public function deletingItem($itemId, $itemName)
    {
        $this->item['id'] = $itemId;
        $this->delete['item'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Confirm',
            'content' => 'Are you sure you want to delete this item? "' . $itemName . '"'
        ]); 
    }

    public function deletingItems()
    {
        $this->delete['items'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Confirm',
            'content' => 'Are you sure you want to delete this item(s)?'
        ]); 
    }

    public function deleteItem()
    {

        $deleteItem = Item::find($this->item['id']);

        if (isset($deleteItem->item_image)) {
            Storage::disk('items')->exists($deleteItem->item_image) ?
                Storage::disk('items')->delete($deleteItem->item_image) : '' ;
        }

        $deleteItem->delete();
        $this->reset(['item']);
        $this->confirm_dialog_modal_close();
        $this->dispatchBrowserEvent('toast',[
                'title' => null,
                'class' => 'success',
                'message' => 'Item has been successfully deleted.',
        ]);
    }

    public function deleteItems()
    {
        $items = Item::find($this->selectedItems);

        foreach ($items as $item) {
            if (!empty($item->item_image)) {
                Storage::disk('items')->exists($item->item_image) 
                    ? Storage::disk('items')->delete($item->item_image) : '';
            }
        }

        Item::destroy($this->selectedItems);

        $this->selectedItems = [];

        $this->confirm_dialog_modal_close();

        $this->dispatchBrowserEvent('toast', [
            'title' => null,
            'class' => 'success',
            'message' => 'Item(s) has been successfully deleted.',
        ]);
    }


    public function totalIn($itemId)
    {
        return In_item::select(['id'])->where('item_id', $itemId)->where('status', true)->count();
    }

    public function totalOut($itemId)
    {
        return In_item::select(['id'])->where('item_id', $itemId)->where('status', false)->count();
    }


    public function inItem($itemId)
    {
        $this->item['id'] = $itemId;

        $this->validate([
            'item.in' => 'nullable|integer',
            'item.buffer' => 'nullable|integer'
        ]);

        if (!empty($this->item['in']) || !empty($this->item['buffer'])) {
            
            $item = Item::findOrFail($this->item['id']);

            if (empty($this->item['in'])) {
                $item->update(['item_buffer' => $this->item['buffer']]);}

            if (empty($this->item['buffer']) && ($this->item['in'] != 0)) {
                $item->update(['item_qty' => DB::raw('item_qty + ' . $this->item['in'])]);
                In_item::create([
                    'item_id' => $this->item['id'], 
                    'status' => true, 
                    'qty' => $this->item['in']
                ]);}

        } else {}

        $this->reset(['item']);
    }



    public function selectedItem($itemId) 
    {
        $item = Item::findOrFail($itemId);
        $this->getItem($item);
        $this->modal['displayItem'] = true;
    }




    public function tabDisplayActiveItem($value)
    {
        return $value == 'all' ? 'All Items' : Category::where('id', $value)->first()->name;
    }


    public function countItems($type)
    {
        return $type == 'all' ? Item::all()->count() : Item::where('category_id', $type)->count();
    }





    


    public function confirm()
    {
        $this->delete['item']       
            ? $this->deleteItem()   
            : NULL;
        $this->delete['items']      
            ? $this->deleteItems()  
            : NULL;
        $this->delete['category']
            ? $this->deleteCategory()
            : NULL;

        $this->reset(['delete']);
    }

    public function showModal($action, $id)
    {
        $this->resetFields();

        switch ($action) {
            case 'add':
                $this->modal['add'] = true;
                $this->modal['show'] = true;
                break;

            case 'update':
                $item = Item::findOrFail($id);
                $this->getItem($item);

                !empty($item->item_image) || ($item->item_image != null) ? 
                    $this->item['has_image'] = true : '';
    
                $this->modal['update'] = true;
                $this->modal['show'] = true;
                break;

            case 'inItem':
                $this->modal['inItem'] = true;
                $this->modal['show'] = true;
                break;

            case 'addCategory':
                $this->modal['category'] = true;
                $this->modal['show'] = true;
                break;
                
            case 'updateCategory':
                $cat = Category::findOrFail($id);
                $this->cat['id']   = $cat->id;
                $this->cat['name'] = $cat->name;
                $this->cat['desc'] = $cat->desc;

                $this->modal['category'] = true;
                $this->modal['show'] = true;
                break;
            default:
        }
    }


    public function showImage($imageName, $itemName, $itemCategory)
    {
        $this->modal['show_image'] = true;
        $this->item['image'] = $imageName;
        $this->item['name'] = $itemName;
        $this->item['cat'] = $itemCategory;
    }

    public function closeModal()
    {
        $this->resetFields();
        $this->confirm_dialog_modal_close();
        $this->reset(['searchItem']);
    }
    




    public function getItem($item)
    {
        $this->item['id']         = $item->id;
        $this->item['name']       = $item->item_name;
        $this->item['cat']        = $item->category_id;
        $this->item['type']       = $item->item_type; 
        $this->item['price']      = $item->item_price;
        $this->item['supplier']   = $item->supplier_id;
        $this->item['qty']        = $item->item_qty;
        $this->item['size']       = $item->item_size;
        $this->item['buffer']     = $item->item_buffer;
        $this->item['cost']       = $item->item_cost;
        $this->item['image']      = $item->item_image;

        // $this->item['desc']       = $item->item_desc;
        
    }

    public function setItem()
    {
        return [
            'item_name'     => $this->item['name'],
            'category_id'   => $this->item['cat'] ?? '',
            'item_desc'     => $this->item['desc'],
            'item_price'    => $this->item['price'],
            'supplier_id'   => $this->item['supplier'] ?? NULL, 
            // 'item_qty'      => $this->item['qty'] + $this->item['buffer'],
            'item_size'     => $this->item['size'],
            'item_buffer'   => $this->item['buffer'],
            'item_cost'     => $this->item['cost'],
        ];

        // 'item_type'     => $this->item['type'],
    }

    public function setColor($catId, $cvalue, $cname)
    {
        Category::find($catId)->update(['cvalue' => $cvalue, 'cname' => $cname]);
    }




    public function activePage($subPageValue)
    {
        return $this->subPage == $subPageValue ? 'active' : '';
    }

    public function confirm_dialog_modal_close() { $this->dispatchBrowserEvent('confirm-dialog-close'); }


    public function stocks($itemId) 
    {
        $stocks = 0;

        $in_out_items = In_item::where('item_id', $itemId)->where('status',true)->get();

        foreach ($in_out_items as $in_out) {
            $stocks += $in_out->qty;
        }
        
        return $stocks;
    }

    public function lowStocks($itemId)
    {
        $item = Item::select(['item_buffer','item_qty'])->find($itemId);

        if ($item->item_qty <= $item->item_buffer)
            return true;
        else
            return false;
    }

    // public function storage($disk, $url) 
    // {
    //     if (!empty($url) || ($url != null)) {
    //         return Storage::disk($disk)->url($url); } 
    //     else {
    //         if ($disk == 'avatars') {
    //             return Storage::disk($disk)->url('default-user-avatar.png'); } 
    //         elseif ($disk == 'items') { 
    //             return Storage::disk($disk)->url('default-item-image.jpg'); }
    //     }
    // }
}



