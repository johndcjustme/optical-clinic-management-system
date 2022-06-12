<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Cash_type;
use App\Models\Purchase;
use App\Models\Payment;
use App\Models\Payment_record;

class PageLedger extends Component
{
    public $selectAll = false;

    public $subPage = 3;

    public $startBal;

    public $selectedItems = [];
    
    // public $selectedCredits = [];

    public $otherCashType;

    public $cashTypeId;

    public $viewPayments = false;

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
        'pay_amount' => 0,
    ];

    public $confirm = [
        'deleteCashType' => false,
        'batchdeleteCashType' => false,
        'deletePayment' => false,
        'deletePayments' => false,
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
                $payments = Payment::with(['records'])->select(['id', 'description', 'notify', 'payable', 'balance', 'payment_type', 'due']);
                $cashtypes = Cash_type::select(['type'])->get();

                $viewpayments = Payment_record::where('payment_id', $this->payment['id'])->orderByDesc('id')->get();

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
                    'viewpayments' => $viewpayments, 
                    'payments' => $payments->orderBy('id', 'asc')->get(),
                    'cashtypes' => $cashtypes,
                ];
                break;
            case 3:
                $purchases = Purchase::select([
                    'id',
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


    public function viewPaymentRecords($paymentId, $paymentDesc)
    {
        $this->viewPayments = true;
        $this->payment['id'] = $paymentId;
        $this->payment['desc'] = $paymentDesc;

    }


    public function pay()
    {

        // dd($this->payment['id'] . ', ' . $this->payment['amount']);


        $validate = [
            'payment.partial' => 'required',
        ];

        if ($this->payment['partial'] == 'paid') {
            $validate += [
                'payment.partial' => 'required|numeric'
            ];
        }

        $this->validate($validate);

        if (empty($this->payment['type'])) {
            $this->payment['type'] = 'None';
        }


        


        $payment_record = Payment_record::where('payment_id', $this->payment['id'])->get();
        $total_payment = $payment_record->sum('pay_amount') + $this->payment['pay_amount'];

        if ($this->payment['partial'] == 'paid') {

            if ($this->payment['amount'] == $total_payment) {
                dd('paid already');
            } else {
                $this->payment['pay_amount'] = 0; 
                $this->payment['pay_amount'] = $this->payment['amount'] - $total_payment;
    
                Payment_record::create([
                    'payment_id' => $this->payment['id'],
                    'pay_amount' => $this->payment['pay_amount'], 
                    'payment_type' => $this->payment['type']
                ]);
            }

        } elseif ($this->payment['partial'] == 'partial') {
            // if ($this->payment['amount'] > $this->payment['pay_amount']) {

            if (empty($this->payment['pay_amount'])) {
                dd('Amount should not be empty.');
            }
                
            if (($this->payment['amount'] > $total_payment) && ($this->payment['pay_amount'] != 0)) {
                Payment_record::create([
                    'payment_id' => $this->payment['id'],
                    'pay_amount' => $this->payment['pay_amount'], 
                    'payment_type' => $this->payment['type']
                ]);         
    
                $this->reset(['payment']);
                $this->closeModal();
    
            } elseif ($this->payment['amount'] == $total_payment) {
                dd('paid anyway');
            } else {
                dd('payment greater than the total payment or payment is 0');
            }
        }


            // Payment_record::create([
            //     'payment_id' => $this->payment['id'],
            //     'pay_amount' => $this->payment['balance'], 
            //     'payment_type' => $this->payment['type']
            // ]);
             
            // Payment::select(['id', 'balance', 'payment_type'])->findOrFail($this->payment['id'])->update($payment);

          
        // } else {
        //     $this->dispatchBrowserEvent('toast', [
        //         'class' => 'error',
        //         'title' => 'Error',
        //         'message' => 'Amount should not be greater than the total to be paid',
        //     ]);
        // }
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

    public function deletingPayments()
    {
        $this->confirm['deletePayments'] = true;
        $this->dispatchBrowserEvent('confirm-dialog', [
            'title' => 'Delete Payment',
            'content' => 'Selected payments will be deleted. Procced?',
        ]);
    }

    public function deletedPayments()
    {
        $deleted = Purchase::destroy($this->selectedItems);
        if ($deleted) {
            $this->dispatchBrowserEvent('confirm-dialog-close');
            $this->dispatchBrowserEvent('toast', [
                'class' => 'success',
                'title' => 'Deleted',
                'message' => 'Payments has been successfully removed.',
            ]);
        }
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
        $this->confirm['deletePayments']
            ? $this->deletedPayments()
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
                $this->reset(['payment']);
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
        // $this->reset(['modal', 'payment']);
        $this->reset(['modal']);
        $this->resetErrorBag();
    }

    public function resetField()
    {
        $this->reset([
            'modal',
            'payment',
        ]);
    }
}
