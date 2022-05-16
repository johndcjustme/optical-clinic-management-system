<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Cash_type;

class PageLedger extends Component
{
    public $selectAll = false;

    public $subPage = 1;

    public $startBal;

    public $selectedItems = [];

    public $otherCashType;

    public $cashTypeId;

    public $confirm = [
        'deleteCashType' => false,
        'batchdeleteCashType' => false,
    ];

    public $cashTypes = [
        'Cash on Hand',
        'GCash',
        'paymaya',
    ];

    public $cashInBank = [
        'bank 1',
        'bank 2',
        'bank 3',
        'bank 4',
    ];

    protected $queryString = [
        'subPage',
    ];



    public function render()
    {
        return view('livewire.pages.page-ledger', [
            'cashtypes' => Cash_type::all(),
        ])
            ->extends('layouts.app')
            ->section('content');
    }


    public function addCashType($cashName = null)
    {
        if($cashName != null) {
            Cash_type::create(['type' => $cashName]);
        } else {

            $this->validate(['otherCashType' => 'required']);

            Cash_type::create(['type' => $this->otherCashType]);

            $this->reset(['otherCashType']);
        }

        $this->dispatchBrowserEvent('toast', [
            'class' => 'success',
            'title' => 'Success',
            'message' => 'Cash type has been added to the list.',
        ]);
    }

    public function deletingCashType($id)
    {
        $this->cashTypeId = $id;
        $this->confirm['deleteCashType'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Are you sure?',
            'content' => 'Cash type will be deleted. Do you want to proceed?',
        ]); 
    }

    public function batchDeletingCashType()
    {
        $this->confirm['batchdeleteCashType'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Are you sure?',
            'content' => 'Selected cash type will be deleted. Do you want confirm?',
        ]); 
    }

    public function batchDeleteCashType()
    {
        Cash_type::destroy($this->selectedItems);
    }

    public function deleteCashType()
    {
        Cash_type::destroy($this->cashTypeId);
        $this->reset(['confirm', 'cashTypeId']);
        $this->dispatchBrowserEvent('confirm-dialog-close');
    }
    
    public function updateBeginningBal($id)
    {
        $this->validate(['startBal' => 'required|numeric']);
        Cash_type::findOrFail($id)->update(['start_bal' => $this->startBal]);
        $this->reset(['startBal']); 
    }

    public function confirm()
    {
        $this->confirm['deleteCashType'] 
            ? $this->deleteCashType()
            : '';
        $this->confirm['batchdeleteCashType']
            ? $this->batchdeleteCashType()
            : '';
    }
}
