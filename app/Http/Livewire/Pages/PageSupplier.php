<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PageSupplier extends Component
{
    use WithFileUploads;
    use WithPagination;



    public $selectedSuppliers = [];

    public $searchSupplier;

    public $pageNumber = 10;

    public $previewAvatar;

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
    ];

    public $delete = [
        'supplier'  => false,
        'suppliers' => false,
    ];


    public 
        $su_sortDirection = 'asc',        
        $su_sortColumn = 'supplier_name';

    public 
        $direction = 'asc',
        $colName = ''; 

    public $modal = [
        'show' => false,
        'add' => false,
        'update' => false,
    ];

    protected $queryString = [
        'searchSupplier' => ['except' => '']
    ];

    public function render()
    {

        $this->colName = 'supplier_name';

        $searchSupplier = $this->searchSupplier . '%';
        $suppliers = Supplier::where('supplier_name', 'like', $searchSupplier)
            ->orWhere('supplier_address', 'like', $searchSupplier)
            ->orWhere('supplier_contact_no', 'like', $searchSupplier)
            ->orWhere('supplier_email', 'like', $searchSupplier)
            ->orderBy('supplier_name', $this->direction)
            ->paginate($this->pageNumber);

        return view('livewire.pages.page-supplier', ['suppliers' => $suppliers])
            ->extends('layouts.app')
            ->section('content');
    }


    public function updatedSearchSupplier() {
        $this->resetPage();
    }

    public function emptySupplier()
    {
        return Supplier::all()->count() > 0 ? true : false;
    }

    public function orderBy($colName, $direction)
    {
        $this->resetPage();

        $this->colName = $colName;
        $this->direction = $direction;
    }


    public function setSupplier()
    {
        $this->validate( 
            [
                'su.name' => 'required',
                'su.email' => 'required|email',
                'su.no' => 'required',
                'previewAvatar' => 'image|max:1024|nullable',
            ],
            [
                'su.name.required' => 'Required',
                'su.email.email' => 'Enter valid email',
                'su.no.required' => 'Required',
                'su.email.required' => 'Required',
            ]
        );

        return [
            'supplier_name'         => $this->su['name'],
            'supplier_address'      => $this->su['address'],
            'supplier_contact_no'   => $this->su['no'],
            'supplier_email'        => $this->su['email'],
            'supplier_bank'         => $this->su['bank'],
            'supplier_acc_no'       => $this->su['acc'],
            'supplier_branch'       => $this->su['branch'],
        ];
    }


    public function addSupplier()
    {
        $createSupplier = $this->setSupplier();

        if (!empty($this->previewAvatar) || ($this->previewAvatar != null)) {
            $createSupplier += ['supplier_avatar' => $this->previewAvatar->hashName()];
            $this->previewAvatar->store('/', 'avatars');            
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
        $supplier = Supplier::findOrFail($supplierId);
        $updateSupplier = $this->setSupplier();

        if (!empty($this->previewAvatar) || ($this->previewAvatar != null)) {
            Storage::disk('avatars')->exists($supplier->supplier_avatar) ? 
                Storage::disk('avatars')->delete($supplier->supplier_avatar) : '';
            
            $updateSupplier += ['supplier_avatar' => $this->previewAvatar->hashName()];
            $this->previewAvatar->store('/', 'avatars');
        }

        $supplier->update($updateSupplier);
        $this->closeModal();
        $this->dispatchBrowserEvent('toast', [
            'title' => null,
            'class' => 'success',
            'message' => 'Supplier updated successfully.',
        ]);
    }







    public function deletingSupplier($supplierId, $supplierName)
    {
        $this->su['id'] = $supplierId;
        $this->delete['supplier'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Confirm',
            'content' => 'Are you sure you want to delete this supplier? "' . $supplierName . '"'
        ]); 
    }

    public function deletingSuppliers()
    {
        $this->delete['suppliers'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Confirm',
            'content' => 'Are you sure you want to delete this supplier(s)?'
        ]); 
    }

    public function deleteSupplier()
    {

        $supplier = Supplier::find($this->su['id']);

        if (isset($supplier->supplier_avatar)) {
            Storage::disk('avatars')->exists($supplier->supplier_avatar) ?
                Storage::disk('avatars')->delete($supplier->supplier_avatar) : '' ;
        }
        
        $supplier->delete();
        $this->reset(['su']);
        $this->confirm_dialog_modal_close();
        $this->dispatchBrowserEvent('toast', [
            'title' => 'Success',
            'class' => 'success',
            'message' => 'Supplier has been successfully deleted.',
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
        $this->reset(['su']);
        $this->confirm_dialog_modal_close();
        $this->dispatchBrowserEvent('toast', [
            'title' => 'Success',
            'class' => 'success',
            'message' => 'Supplier(s) has been successfully deleted.',
        ]);
    }

    public function confirm()
    {
        $this->delete['supplier']   
            ? $this->deleteSupplier() 
            : NULL;
        $this->delete['suppliers']   
            ? $this->deleteSuppliers() 
            : NULL;

        $this->reset(['delete']);
    }




    public function showModal($action, $id)
    {
        if ($action == 'update') {
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
            $this->modal['update'] = true;

        } elseif ($action == 'add') {
            $this->modal['add'] = true; 
        }

        $this->modal['show'] = true;
    }

    public function closeModal()
    {
        $this->reset(['su', 'modal', 'previewAvatar']);
        $this->resetErrorBag();
        $this->confirm_dialog_modal_close();
    }
    
    public function confirm_dialog_modal_close() { $this->dispatchBrowserEvent('confirm-dialog-close'); }

    public function storage($url) 
    {
        if (!empty($url) || ($url != NULL)) 
            return Storage::disk('avatars')->url($url); 
        else 
            return Storage::disk('avatars')->url('default-user-avatar.png'); 
    }
}
