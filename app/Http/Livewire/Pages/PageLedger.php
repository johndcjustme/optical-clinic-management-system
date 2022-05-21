<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Cash_type;
use App\Models\Purchase;
use App\Models\Payment;

class PageLedger extends Component
{
    public $selectAll = false;

    public $subPage = 3;

    public $startBal;

    public $selectedItems = [];

    public $otherCashType;

    public $cashTypeId;

    public $paid = 'all', $all = false;

    public $displayPayment = '';

    public $modal = [
        'show' => false,
            'add' => false,
            'update' => false,
            'pay' => false,
    ];

    public $payment = [
        'id' => '',
        'desc' => '',
        'amount' => '',
        'due' => '',
        'partial' => '',
        'type' => '',
        'balance' => '',
    ];

    public $confirm = [
        'deleteCashType' => false,
        'batchdeleteCashType' => false,
        'deletePayment' => false,
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
        'paid' => ['except' => ''],
    ];



    public function render()
    {
        $render = [];
        
        
        switch ($this->subPage) {
            case 1:
                $render = [
                    'cashtypes' => Cash_type::all(),
                ];
                break;

            case 2:
                $payments = Payment::select(['id', 'description', 'notify', 'payable', 'balance', 'payment_type', 'due']);
                $cashtypes = Cash_type::select(['type'])->get();

                // if (($this->paid == true) || ($this->paid == false)) {
                //     if ($this->paid == false) {
                //         $payments->whereColumn('payable', '>' , 'balance');
                //     } else {
                //         $payments->whereColumn('payable', '=' , 'balance');
                //     }
                // } 

                if ($this->displayPayment == 'paid') {
                    $payments->whereColumn('payable', '=' , 'balance');
                }

                if ($this->displayPayment == 'unpaid') {
                    $payments->whereColumn('payable', '>' , 'balance');
                }

                $render = [
                    'payments' => $payments->orderBy('id', 'asc')->get(),
                    'cashtypes' => $cashtypes,
                ];
                break;
            case 3:
                $purchases = Purchase::select([
                    'patient_id',
                    'qty',
                    'total',
                    'discount',
                    'balance',
                    'deposit',
                    'duedate',
                    'payment_type',
                    'created_at',
                ])->with(['patient'])->where('total', '>', 0)->orderBy('balance', 'desc')->get(); 
                
                $render = [
                    'purchases' => $purchases,
                ];
                break;
            default:
        }


        return view('livewire.pages.page-ledger', $render)
            ->extends('layouts.app')
            ->section('content');
    }



    public function pay()
    {

        $this->validate([
            'payment.partial' => 'required',
            'payment.type' => 'required',
        ]);

        if ($this->payment['amount'] > $this->payment['balance']) {
            $payment = [
                'payment_type' => $this->payment['type']
            ];
    
            if ($this->payment['partial'] == 'partial') 
                $payment += [
                    'balance' => $this->payment['balance']
                ];
            elseif ($this->payment['partial'] == 'paid') 
                $payment += [
                    'balance' => $this->payment['amount']
                ];
             
            Payment::select(['id', 'balance', 'payment_type'])->findOrFail($this->payment['id'])->update($payment);
    
            $this->closeModal();
        } else {
            $this->dispatchBrowserEvent('toast', [
                'class' => 'error',
                'title' => 'Error',
                'message' => 'Amount should not be greater than the total to be paid',
            ]);
        }
    }


    public function addPayment($paymentId = null)
    {

        $message = $paymentId == null ? 'Added' : 'Updated';

        $this->validate(
        [
            'payment.desc' => 'required|max:255',
            'payment.amount' => 'required|numeric',
        ],
        [
            'payment.desc.required' => 'Required',
            'payment.amount.required' => 'Required',
        ]);

        $createPayment = [
            'description' => $this->payment['desc'],
            'payable' => $this->payment['amount'],
            'notify' => false,
            'balance' => 0,
        ];

        if (! empty($this->payment['due'])) {
            $createPayment += [
                'date' => $this->payment['due'] ?? null,
            ];
        }

        Payment::updateOrCreate(['id' => $paymentId], $createPayment);

        $this->reset(['payment', 'modal']);

        $this->dispatchBrowserEvent('toast', [
            'class' => 'success',
            'title' => 'Success',
            'message' => $message . ' successfully',
        ]);
    }

    public function deletingPayment($paymentId) 
    {
        $this->payment['id'] = $paymentId;
        $this->confirm['deletePayment'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Delete Payment',
            'content' => 'Payment will be deleted. Procced?',
        ]);
    }

    public function deletedPayment()
    {
        Payment::destroy($this->payment['id']);
        $this->dispatchBrowserEvent('confirm-dialog-close');
        $this->dispatchBrowserEvent('toast', [
            'class' => 'success',
            'title' => 'Success',
            'message' => 'Payment deleted successfully',
        ]);
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
        $this->confirm['deletePayment']
            ? $this->deletedPayment()
            : '';
    }

    public function setPayment($payment)
    {
        $this->payment['id'] = $payment->id;
        $this->payment['due'] = $payment->due;
        $this->payment['desc'] = $payment->description;
        $this->payment['amount'] = $payment->payable;
        $this->payment['type'] = $payment->payment_type;
    }

    public function showModal($action, $paymentId = null)
    {

        switch ($action) {
            case 'add':
                $this->modal['add'] = true;
                break;

            case 'update':
                $this->modal['update'] = true;
                $payment = Payment::find($paymentId);
                $this->setPayment($payment);
                break;

            case 'pay':
                $this->modal['pay'] = true;
                $payment = Payment::find($paymentId);
                $this->setPayment($payment);
                break;
            default:
        }

        $this->modal['show'] = true;
    }
    

    public function closeModal()
    {
        $this->reset(['modal', 'payment']);
        $this->resetErrorBag();
    }
}
